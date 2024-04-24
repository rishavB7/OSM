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

class DepartmentManagementController extends Controller
{
    public function addDepartment(Request $request) {
        if ($request->isMethod('get')) {
        
            return view('District_Admin.addDepartment');
        } else {
            $validatedData = $request->validate([
                'department_name' => ['required'],
            ]);

           
            DB::beginTransaction();
            try{

                        $deptName = Departments::on(Session::get('db_conn_name'))->create([
                            'department_name' => $request->department_name,
                        ]);

                        DB::commit();
                        return redirect()->route('addDepartment')->with('alert-success', 'Department Created Successfully');

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

    public function departmentList(Request $request) {
        $departments = Departments::on(Session::get('db_conn_name'))->get();
        return view('District_Admin.departmentList', ['departments' => $departments]);
    }
}
