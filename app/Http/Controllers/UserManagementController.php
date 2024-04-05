<?php

namespace App\Http\Controllers;
use DB;
use Session;
use App\Models\User;
use App\Models\Departments;
use Illuminate\Http\Request;
use App\Models\District_Master;
use App\Models\District_User_Map; 
use App\Models\SubDistrict_User_Map; 
use App\Models\SubDistrictMaster;
use App\Models\Department_User_Map;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function user_create(Request $request) {
        if ($request->isMethod('get')) {
            // $title = 'Create User';
            $districts = District_Master::get();
            $data['districts'] = District_Master::orderBy('id', 'asc')->get();

            // $data = compact('title', 'districts',);
            return view('Master_Admin.user_create', $data);
        } else {
            $validatedData = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'string'],
                'password' => ['required', 'confirmed'],
                'mobile' => ['required', 'digits:10'],
                'role' => ['required'],
            ]);

            // if($request->role == 2 || $request->role == 3) {
            //     $validatedData = $request->validate([
            //         'district' => ['required'],
            //     ]);
            // }

            DB::beginTransaction();
            try{

                        $user = User::create([
                            // 'id' => rand(001, 999),
                            'role' => $request->role,
                            'status' => 1,
                            'name' => $request->name,
                            'email' => trim(strtolower($request['email'])),
                            'mobile' => trim($request['mobile']),
                            'password' => Hash::make($request['password']),
                            // 'district' => $request['district'],
                        ]);

                        if($request->role == 2) {
                            $district_name = District_Master::where('id', $request['district'])->first();
                           
                            $user_dist_map = District_User_Map::create([
                                'user_id' => $user->id,
                                "district_unique_code" => $district_name->unique_code,
                            ]);
                        }


                        DB::commit();
                        return redirect()->route('user_create')->with('alert-success', 'User Created Successfully');

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


    public function addUser(Request $request) {
        if ($request->isMethod('get')) {
            $data['districts'] = District_Master::orderBy('id', 'asc')->get();
            $data['department_name'] = Departments::on(Session::get('db_conn_name'))->get();
            // dd('sad');
            return view('District_Admin.addUser', $data);
        } else {
            $validatedData = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'string'],
                'password' => ['required', 'confirmed'],
                'mobile' => ['required', 'digits:10'],
                'role' => ['required'], 
                'department_name' => ['required']
            ]);


            DB::beginTransaction();
            try{
    
                    $user = User::create([
                        'role' => $request->role,
                        'status' => 1,
                        'name' => $request->name,
                        'email' => trim(strtolower($request['email'])),
                        'mobile' => trim($request['mobile']),
                        'password' => Hash::make($request['password']),
                    ]);
            
                    if($request->role == 3 || $request->role == 4) {
                
                       
                        $user_dist_map = District_User_Map::create([
                            'user_id' => $user->id,
                            "district_unique_code" => session::get('district_unique_code'),
                        ]);
            

                        $user_department_map = Department_User_Map::on(Session::get('db_conn_name'))->create([
                            'user_id' => $user->id, 
                            'department_id' => $request->department_name, 
                        ]);
                    }

                    DB::commit();

                    return redirect()->route('addUser')->with('alert-success', 'User Created Successfully');
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




    public function list_user(Request $request) {


        $data['all_users'] = District_User_Map::with(['user','district_master'])->get();
        // $data['all_users'] = User::orderBy('role', 'asc')->get();

        // $data['districts'] = District_Master::get();

        return view('listUser', $data);
    }
    public function list_user_by_district(Request $request) {


        $dc_sdo_district = Auth::user()->district_master?->district; 
        
        // dd($dc_sdo_district);

        $all_users = District_User_Map::with('user', 'district_master')
            ->whereHas('user', function ($query) use ($dc_sdo_district) {
                $query->where('role', 2); // Filter users with role DC/SDO Admin
            })
            ->whereHas('district_master', function ($query) use ($dc_sdo_district) {
                $query->where('district', $dc_sdo_district);
            })
            ->get();

         return view('District_Admin.listUserByDistrict', compact('all_users'));
    }


    // public function editUser($id) {
    //     $all_users = User::find($id);

    //     if(is_null($all_users)) {
    //         return redirect('listUser');

    //     } else {
    //         $url = url('/dashboard/update') .'/'. $id;
    //         $title = 'Update User';
    //         $districts = District_Master::get();
    //         $data = compact('all_users', 'districts', 'title');
    //         return view('Master_Admin.user_create')->with($data);
    //     }
    // }

    public function updateUser(Request $request, $id) {

        if ($request->isMethod('get')) {

            $data['districts'] = District_Master::get();

            $data['user'] = User::where('id', $id)->first();
            return view('Master_Admin.updateUser', $data);
        } else {
            
            
            $validatedData = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'string'],
                'password' => ['required', 'confirmed'],
                'mobile' => ['required', 'digits:10'],
            ]);
            
            // dd('asbdghsafudgsad'); 

            $user = User::where('id', $id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            return redirect()->route('updateUser', $id)->with("alert-success", "User Successfully Updated!");
        }
    }
}
