<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Departments;
use Illuminate\Http\Request;
use App\Models\District_Master;
use App\Models\District_User_Map;
use App\Models\Department_User_Map;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;
class UserManagementController extends Controller
{
    public function user_create(Request $request) {
        if ($request->isMethod('get')) {
            $data['districts'] = District_Master::get();
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
                            'id' => rand(001, 999),
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
            $data['districts'] = District_Master::get();
            $data['department_name'] = Departments::on('conn_golaghat')->get();
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

                    // Successfully run.
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




    public function list_user(Request $request)
    {


        // $data['all_users'] = Election_district_user_map::with(['user','election_district_master'])->get();
        $data['all_users'] = User::orderBy('role', 'asc')->get();

        return view('listUser', $data);
    }


    // public function user_status(Request $request) {

    //     // dd('comming');
    //     $id = $request->get('id');
    //     // dd($id);
    //     if ($id != '') {
    //         $data = User::where('id', $id)->first();
    //         if ($data->status == 0) {
    //             User::where('id', $id)->update(['status' => 1]);
    //             // return redirect()->route('admin.list.employee');
    //             return redirect()->route('listUser')->with("alert-success", "User Successfully Activated!");
    //         } else {
    //             User::where('id', $id)->update(['status' => 0]);
    //             // return redirect()->route('admin.list.employee');
    //             return redirect()->route('listUser')->with("alert-success", "User Successfully Deactivated!");
    //         }
    //         // $redir_url = $request->session()->get('ref_url');
    //         // return redirect($redir_url);


    //         // return redire
    //     } else {
    //         // dd('comming');
    //         return redirect('/');
    //     }
    // }
}

