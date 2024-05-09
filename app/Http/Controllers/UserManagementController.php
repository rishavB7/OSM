<?php

namespace App\Http\Controllers;
use DB;
use Session;
use App\Models\User;
use App\Models\Departments;
use Illuminate\Http\Request;
use App\Models\District_Master;
use App\Models\District_User_Map; 
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
                'designation' => ['required'],
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
                            'designation' => $request->designation,
                            'email' => trim(strtolower($request['email'])),
                            'mobile' => trim($request['mobile']),
                            'password' => Hash::make($request['password']),
                            // 'district' => $request['district'],
                        ]);

                        if($request->role == 2 || 4 || 5 || 6) {
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
                // 'designation' => ['required'],
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
                        'designation' => $request->designation,
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

    public function addUserCAtoDC(Request $request) {
        if ($request->isMethod('get')) {
            // dd(Session::get('db_conn_name'));    
            $data['districts'] = District_Master::orderBy('id', 'asc')->get();
            $data['department_name'] = Departments::on(Session::get('db_conn_name'))->get(); 
            // dd($data['department_name']);
            // dd($data['department_name']);
            return view('CA-TO-DC_Admin.addUserCAtoDC', $data);
        } else {
            $validatedData = $request->validate([
                'name' => ['required'],
                // 'designation' => ['required'],
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
                        'designation' => $request->designation,
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

                    return redirect()->route('addUserCAtoDC')->with('alert-success', 'User Created Successfully');
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
        // $department_name = Departments::on(Session::get('db_conn_name'))->get();
        // dd($department_name);
        if(Auth::user()->role == 2 || Auth::user()->role == 4){
            $data['currentUserDistrict'] = District_User_Map::where('user_id', Auth::user()->id)->first()->district_unique_code;
        }

        // $data['deapartmentName'] = Department_User_Map::where('user_id', )->first()->district_unique_code;
        // $data['all_users'] = User::orderBy('role', 'asc')->get();

        // $data['districts'] = District_Master::get();

        return view('listUser', $data);
    }

    public function dc_list(Request $request) {
        $data['dcs'] = User::where('role', 2)->get();
        return view('Master_Admin.dc_list', $data);
    }

    public function nodal_list(Request $request) {
        $data['nodals'] = User::where('role', 3)->get();
        return view('Master_Admin.nodal_list', $data);
    }

    public function active_user_list(Request $request) {
        $data['actUser'] = User::where('status', 1)->get();
        return view('Master_Admin.active_user_list', $data);
    }

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

    // TEST 

    public function updateUserTest(Request $request, $id) {
        // Find the user
        $user = User::findOrFail($id);
    
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
            'mobile' => 'required|string|max:20',
        ]);
    
        // Update user details
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->mobile = $validatedData['mobile'];
    ~
        // Check if password is provided, if not generate a random password
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        } else {
            // Generate a random password
            $randomPassword = generateRandomPassword();
            $user->password = Hash::make($randomPassword);
    
            // Optionally, you can send the random password to the user's email or mobile
            // For example:
            // Mail::to($user->email)->send(new RandomPasswordMail($randomPassword));
            // or
            // SMS::send($user->mobile, 'Your new password: ' . $randomPassword);
        }
    
        $user->save();

        return redirect()->route('listUser')->with('alert-success', 'User updated successfully');
    }

    // function generateRandomPassword($length = 10) {
    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_';
    //     $password = '';
    //     $max = strlen($characters) - 1;
    //     for ($i = 0; $i < $length; $i++) {
    //         $password .= $characters[random_int(0, $max)];
    //     }
    //     return $password;
    // }
    
    

    // TEST 

    public function update_password(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            ],
        ], [
            'password.regex' => 'The new password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be at least 8 characters long.',
        ]);


        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        $user = User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request['password']),
            'isPasswordChanged' => 1,
        ]);

        Auth::logout();

        return redirect()->route('login')->with('status', 'Password updated successfully. Please login with your new password.');
    }
}