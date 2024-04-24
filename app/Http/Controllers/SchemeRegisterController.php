<?php

namespace App\Http\Controllers;
use DB;
use Session;
use App\Models\Schemes;
use Illuminate\Http\Request;
use App\Models\ProgressReport;
use App\Models\SchemeProgress;
use App\Models\User;
use App\Models\District_User_Map;
use App\Models\Scheme_Completion;
use App\Models\handle_queries_table;
use Illuminate\Support\Facades\Auth;

class SchemeRegisterController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;

            $district= District_User_Map::with('district_master')->where('user_id', Auth::user()->id)->first();

            if($district->district_master->district == 'West Karbi Anglong'
            || $district->district_master->district == 'South Salmara'
            || $district->district_master->district == 'South Salmara Mancachar'
            || $district->district_master->district == 'North Salmara'
            || $district->district_master->district == 'Kamrup Metro'
            || $district->district_master->district == 'Kamrup Metropolitan'
            || $district->district_master->district == 'WEST KARBI ANGLONG'
            || $district->district_master->district == 'SOUTH SALMARA'       
            || $district->district_master->district == 'SOUTH SALMARA MANCACHAR'       
            || $district->district_master->district == 'NORTH SALMARA'
            || $district->district_master->district == 'KAMRUP METRO'
            || $district->district_master->district == 'KAMRUP METROPOLITAN'
            ){
                Session::put('db_conn_name', 'conn_'.strtolower(str_replace(' ', '_', $district->district_master->district)));
            }else{

                Session::put('db_conn_name', 'conn_'.strtolower( $district->district_master->district));
            }

            Session::put('district_unique_code', $district->district_master->unique_code);
           
            return $next($request);
       });
    }

    public function schemeCreate(Request $request) {
        if($request->isMethod('get')) {
            return view('HOD_Admin.SchemeCreation');
        } else {
            $validatedData = $request->validate([
                'scheme_name' => ['required','string','max:255'],
                'scheme_description' => ['required' ,'string', 'max:255'],
                'start_date' => ['required'],
                'end_date' => ['required'],
                'budget' => ['required'],
                'projectc_coordinator' => ['required'],
            ]);
            DB::beginTransaction();
            try{

            $remainingBudget = $request->budget;

            $this->id = Auth::user()->id;

            $scheme = Schemes::on(Session::get('db_conn_name'))->create([
                'scheme_name' => $request->scheme_name,
                'scheme_description' => $request->scheme_description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 0,
                'scheme_status' => 0,
                'budget' => $request->budget,
                'remaining_budget' => $remainingBudget,
                'projectc_coordinator' => $request->projectc_coordinator,
                'created_by' => Auth::user()->id,     
            ]);

            // $completed_scheme_id = CompletedSchemes::where('id', $request['id'])->first();


            // $completed_schemes_map = CompleteSchemeMap::create([
            //     'scheme_id' => $scheme->id,
            //     "completed_scheme_id" => $completed_scheme_id->id,
            // ]);

            // $scheme = CompletedSchemes::on(Session::get('db_conn_name'))->create([
            //     'scheme_name' => $request->scheme_name,
            //     'scheme_description' => $request->scheme_description,
            //     'start_date' => $request->start_date,
            //     'end_date' => $request->end_date,                
            // ]);

            DB::commit();

            return redirect()->route('dashboard')->with('alert-success', 'Scheme Created Successfully');
        } catch (Exception $e) {
            DB::rollBack();

            $errorCode = $e->getCode();
            if (strpos($errorCode, '42') === 0) {
                $errorMessage = 'You are not permitted to make changes.';
                return view('error_page', ['errorMessage' => $errorMessage]);
            }
            dd('error');
        }
        }
    }

    public function listScheme(Request $request) {
        $data['schemes'] = Schemes::on(Session::get('db_conn_name'))->get();
        $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->get();
        return view('HOD_Admin.listScheme', $data);
    }

    public function updateScheme(Request $request, $id) {
        if ($request->isMethod('get')) {
            // Retrieve scheme details for the given $id
            $data['schemes'] = Schemes::on(Session::get('db_conn_name'))->where('id', $id)->first();
            return view('HOD_Admin.SchemeUpdate', $data); // Pass scheme details to the view
        } else {
            // Validate incoming request data
            $validatedData = $request->validate([
                'scheme_name' => ['required', 'string', 'max:255'],
                'scheme_description' => ['required', 'string', 'max:255'],
                'start_date' => ['required'],
                'end_date' => ['required'],
                'images.*' => ['nullable', 'image', 'mimes:png,jpg,jpeg'], // Validation for multiple images
                'completion_year' => ['nullable'],
                'achievement' => ['nullable'],
                'percentage_of_progress' => ['nullable', 'numeric', 'required'],
                'funds_used' => ['numeric', 'required'],
                'physical_progress' => ['required', 'string', 'max:255'],
            ]);
    
            $imagePaths = [];
    
            // Handle image upload for each file
            foreach ($request->file('images', []) as $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $path = 'assets/uploads/';
                $image->move($path, $filename);
                $imagePaths[] = $path . $filename;
            }
    
            try {
                // Retrieve the scheme details for the given $id
                $scheme = Schemes::on(Session::get('db_conn_name'))->where('id', $id)->first();
    
                // Check if the scheme exists
                if (!$scheme) {
                    // Handle the case where the scheme does not exist
                    return back()->withInput()->with('alert-failed', 'Scheme not found.');
                }
    
                $remainingBudget = $scheme->budget - $request->funds_used;
    
                // Update scheme details in the database
                $updatedScheme = Schemes::on(Session::get('db_conn_name'))->where('id', $id)->update([
                    'scheme_name' => $request->scheme_name,
                    'scheme_description' => $request->scheme_description,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'physical_progress' => $request->physical_progress,
                    'percentage_of_progress' => $request->percentage_of_progress,
                    'images' => json_encode($imagePaths), // Store image paths as JSON
                    'completion_year' => $request->completion_year,
                    'achievement' => $request->achievement,
                    'remaining_budget' => $remainingBudget,
                ]);
    
                $latestSchemeProgress = SchemeProgress::on(Session::get('db_conn_name'))
                    ->where('scheme_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->first();
    
                $noOfEntries = $latestSchemeProgress ? $latestSchemeProgress->no_of_entries + 1 : 1;
                $percentageOfProgress = $request->input('percentage_of_progress');
    
                $log = SchemeProgress::on(Session::get('db_conn_name'))->create([
                    'scheme_id' => $id,
                    'no_of_entries' => $noOfEntries,
                    'percentage_of_progress' => $percentageOfProgress,
                    'images' => json_encode($imagePaths),
                    'funds_used' => $request->funds_used, // Fix the variable name here
                    'physical_progress' => $request->physical_progress,
                ]);
    
                if ($request->completion_year) {
                    Schemes::on(Session::get('db_conn_name'))->where('id', $id)->update([
                        'scheme_status' => 1,
                    ]);
                }
    
                if ($request->completion_year == null) {
                    Schemes::on(Session::get('db_conn_name'))->where('id', $id)->update([
                        'scheme_status' => 0,
                    ]);
                }
    
                if ($updatedScheme) {
                    // If update successful, redirect with success message
                    return redirect()->route('SchemeUpdate', $id)->with('alert-success', 'Scheme Updated Successfully');
                } else {
                    // If update fails, redirect back with error message
                    return back()->withInput()->with('alert-failed', 'Failed to Update Scheme');
                }
            } catch (\Exception $e) {
                // Handle any exceptions or errors during update process
                return back()->withInput()->with('alert-failed', 'An error occurred while updating the scheme: ' . $e->getMessage());
            }
        }
    }
    

    public function deleteScheme(Request $request, $id) {
        try {
            // Find the scheme by its ID and delete it from the database
            $deleted = Schemes::on(Session::get('db_conn_name'))->where('id', $id)->delete();
    
            if ($deleted) {
                // If delete successful, redirect with success message
                return redirect()->route('listScheme')->with('alert-success', 'Scheme Deleted Successfully');
            } else {
                // If delete fails, redirect back with error message
                return back()->with('alert-failed', 'Failed to Delete Scheme');
            }
        } catch (\Exception $e) {
            // Handle any exceptions or errors during delete process
            return back()->with('alert-failed', 'An error occurred while deleting the scheme: '.$e->getMessage());
        }
    }

    public function schemeInfo(Request $request, $id) {
        if($request->isMethod('get')) {
            $data['scheme_id'] = Schemes::on(Session::get('db_conn_name'))->where('id', $id)->first();

            return view('HOD_Admin.SchemeInfo', $data); // Pass scheme details to the view
        } else {
            // Validate incoming request data
            $validatedData = $request->validate([
                'scheme_name' => ['required', 'string', 'max:255'],
                'scheme_description' => ['required', 'string', 'max:255'],
            ]);
        }
    }
    public function progressLog(Request $request, $schemeId) {
  
        if($request->isMethod('get')) {
            // $data['scheme_id'] = Schemes::on(Session::get('db_conn_name'))->where('id', $scheme_id)->first();
            // $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->get();
            // $data['schemes'] = Schemes::on(Session::get('db_conn_name'))->get();
            // $data['scheme'] = Schemes::on(Session::get('db_conn_name'))->find($schemeId);
            $data['scheme'] = Schemes::on(Session::get('db_conn_name'))->where('id', $schemeId)->first();
            $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->where('id', $schemeId)->first();
        
            return view('HOD_Admin.progressLog', $data);
            //
        } else {
            // // Validate incoming request data
            // $validatedData = $request->validate([
            //     'scheme_name' => ['required', 'string', 'max:255'],
            //     'pending_queries' => ['required', 'string', 'max:255'],
            //     'start_date' => ['required']
            // ]);
            DB::beginTransaction();
            try{
            $scheme = handle_queries_table::on(Session::get('db_conn_name'))->create([
                'scheme_name' => $request->scheme_name,
              
                'start_date' => $request->start_date,
               'pending_queries' => $request->pending_queries
                
            ]);
            DB::commit();

            return redirect()->route('dashboard')->with('alert-success', 'Query Successfully Rasised');
        } catch (Exception $e) {
            DB::rollBack();

            $errorCode = $e->getCode();
            if (strpos($errorCode, '42') === 0) {
                $errorMessage = 'You are not permitted to make changes.';
                return view('error_page', ['errorMessage' => $errorMessage]);
            }
            dd('error');
        }
        }
    }



    public function apply($schemeId)
    {
        $scheme = Schemes::on(Session::get('db_conn_name'))->where('id', $schemeId)->first();
        // Use 'first' instead of 'find' to fetch the scheme from the database
    
        if (!$scheme) {
            return redirect()->route('listScheme')->with('error', 'Scheme not found.');
        }
    
        $scheme->status = '1'; // Set status to 'Active'
        $scheme->save();
    
        return redirect()->route('listScheme')->with('success', 'Scheme status updated to active.');
    }

    public function finishedSchemes(Request $request) {
        $data['schemes'] = CompletedSchemes::on(Session::get('db_conn_name'))
                                   ->whereNotNull('completion_year')
                                   ->get();
        return view('HOD_Admin.finishedSchemes', $data);
        
        
      
    }

    }

