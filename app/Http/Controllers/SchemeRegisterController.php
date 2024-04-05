<?php

namespace App\Http\Controllers;
use DB;
use Auth,Session;
use App\Models\Schemes;
use Illuminate\Http\Request;
use App\Models\ProgressReport;
use App\Models\CompletedSchemes;
use App\Models\District_User_Map;
use App\Models\Scheme_Completion;

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
            ]);
            DB::beginTransaction();
            try{

            $scheme = Schemes::on(Session::get('db_conn_name'))->create([
                'scheme_name' => $request->scheme_name,
                'scheme_description' => $request->scheme_description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 0,
                
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
        return view('HOD_Admin.listScheme', $data);
    }

    public function updateScheme(Request $request, $id) {
        if($request->isMethod('get')) {
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
                ]);

                if ($request->completion_year) {
                    Schemes::on(Session::get('db_conn_name'))->where('id', $id)->update([
                        'scheme_status' => 1,
                    ]);
                }
                
                if($request->completion_year == null) {
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
                return back()->withInput()->with('alert-failed', 'An error occurred while updating the scheme: '.$e->getMessage());
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

