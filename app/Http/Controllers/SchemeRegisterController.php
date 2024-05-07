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
use App\Models\Department_User_Map;
use App\Models\Scheme_Supervisor_Map;

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
            $data['supervisors'] = District_User_Map::join('users', 'users.id', '=', 'district_user_map.user_id')
                ->where('district_user_map.district_unique_code', Session::get('district_unique_code'))
                ->where(function($query) {
                    $query->where('users.role', 2)
                        ->orWhere('users.role', 5)
                        ->orWhere('users.role', 6);
                })
                ->get();

            return view('HOD_Admin.SchemeCreation', $data);
        } else {
         
            $validatedData = $request->validate([
                'scheme_name' => ['required', 'string', 'max:255'],
                'scheme_description' => ['required', 'string', 'max:255'],
                'start_date' => ['required'],
                'end_date' => ['required'],
                'budget' => ['required'],
                'project_coordinator' => ['required'],
                'supervisors.*' => ['required'], // Validation rule for supervisors as an array
            ]);
        
            DB::beginTransaction();
            try{

            $remainingBudget = $request->budget;

            $this->id = Auth::user()->id;
            $supervisorId = $request->supervisor;
 

            $scheme = Schemes::on(Session::get('db_conn_name'))->create([
                'scheme_name' => $request->scheme_name,
                'scheme_description' => $request->scheme_description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 0,
                'scheme_status' => 0,
                'budget' => $request->budget,
                'remaining_budget' => $remainingBudget,
                'projectc_coordinator' => $request->project_coordinator,
                'created_by' => Auth::user()->id,
                // 'supervisor' => $supervisorId,     
            ]);

            $schemeId = $scheme->id;

           
            $selectedSupervisors = $request->input('supervisors');  
                       
            foreach ($selectedSupervisors as $supervisorId) {
                $scheme_supervisor_map = Scheme_Supervisor_Map::on(Session::get('db_conn_name'))->create([
                    'supervisor_id' => $supervisorId,
                    'scheme_id' => $schemeId,
                ]);
            }

            DB::commit();

            return redirect()->route('listScheme')->with('alert-success', 'Scheme Created Successfully');
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

    public function deptWiseSchemes(Request $request) {
        if ($request->isMethod('get')) {
            $data['deptUser'] = Department_User_Map::on(Session::get('db_conn_name'))->where('department_id', $request->deptId)->first();
            // dd($data['deptUser']);
    
            if ($data['deptUser'] !== null) {
                $data['schemes'] = Scheme_Supervisor_Map::on(Session::get('db_conn_name'))
                    ->join('schemes', 'schemes.id', '=', 'scheme_supervisor_map.scheme_id')
                    ->where('schemes.created_by', $data['deptUser']->user_id)
                    ->where('scheme_supervisor_map.supervisor_id', Auth::user()->id)
                    ->get();
                  
                // $data['schemes'] = Schemes::on(Session::get('db_conn_name'))->where('created_by', $data['deptUser']->user_id)->get();
                return view('HOD_Admin.listScheme', $data);
            } else {
                // Handle case where department user mapping is not found
                return redirect()->back()->with('error', 'Department user mapping not found.');
            }
        }
    }
    

    public function listScheme(Request $request) {
        $data['schemes'] = Schemes::on(Session::get('db_conn_name'))->get();
        $data['all_users'] = District_User_Map::with(['user','district_master'])->get();
        $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->get();
        return view('HOD_Admin.listScheme', $data);
    }

    public function listNodalScheme(Request $request) {
        $data['schemes'] = Scheme_Supervisor_Map::on(Session::get('db_conn_name'))
        ->join('schemes', 'schemes.id', '=', 'scheme_supervisor_map.scheme_id')
        ->where('scheme_supervisor_map.supervisor_id', Auth::user()->id)
        ->get();


        // $data['schemes'] = Schemes::on(Session::get('db_conn_name'))->get();
        $data['all_users'] = District_User_Map::with(['user','district_master'])->get();
        $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->get();
        return view('listSchemeNodal', $data);
    }

    public function runningSchemesList(Request $request) {
        $data['runningSchemes'] = Scheme_Supervisor_Map::on(Session::get('db_conn_name'))
                ->join('schemes', 'schemes.id', '=', 'scheme_supervisor_map.scheme_id')
                ->where('scheme_supervisor_map.supervisor_id', Auth::user()->id)
                ->where('schemes.scheme_status', 0) 
                ->get();
        $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->get();
        return view('HOD_Admin.runningSchemesList', $data);
    }

    public function runningSchemesListHod(Request $request) {
        $data['runningSchemes'] = Schemes::on(Session::get('db_conn_name'))->where('scheme_status', 0)->get();
        $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->get();
        return view('HOD_Admin.runningSchemesListHod', $data);
    }

    public function runningSchemesListDC(Request $request) {
        $data['runningSchemes'] = Schemes::on(Session::get('db_conn_name'))->where('scheme_status', 0)->get();
        $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->get();
        return view('District_Admin.runningSchemeListDC', $data);
    }
    

    public function completedSchemesList(Request $request) {
        $data['completedSchemes'] = Scheme_Supervisor_Map::on(Session::get('db_conn_name'))
                ->join('schemes', 'schemes.id', '=', 'scheme_supervisor_map.scheme_id')
                ->where('scheme_supervisor_map.supervisor_id', Auth::user()->id)
                ->whereNotNull('schemes.completion_year') 
                ->get();
        $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->get();
        return view('HOD_Admin.completedSchemesList', $data);
    }

    public function completedSchemeListHod(Request $request) {
        $data['completedSchemes'] =  Schemes::on(Session::get('db_conn_name'))
                ->whereNotNull('schemes.completion_year') 
                ->get();
        $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->get();
        return view('HOD_Admin.completedSchemeListHod', $data);
    }

    public function completedSchemeListDC(Request $request) {
        $data['completedSchemes'] =  Schemes::on(Session::get('db_conn_name'))
                ->whereNotNull('schemes.completion_year') 
                ->get();
        $data['schemeProgress'] = SchemeProgress::on(Session::get('db_conn_name'))->get();
        return view('District_Admin.completedSchemeListDC', $data);
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
            DB::beginTransaction();


            $deletedProgress = SchemeProgress::on(Session::get('db_conn_name'))->where('scheme_id', $id)->delete();

            // Find the scheme by its ID and delete it from the database
            $deleted = Schemes::on(Session::get('db_conn_name'))->where('id', $id)->delete();
    
            if ($deleted && $deletedProgress) {
                // If delete successful, redirect with success message
                DB::commit();
                return redirect()->route('listScheme')->with('alert-success', 'Scheme Deleted Successfully');
            } else {
                DB::rollBack();
                // If delete fails, redirect back with error message
                return back()->with('alert-failed', 'Failed to Delete Scheme');
            }
        } catch (\Exception $e) {
            DB::rollBack();
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