<?php

namespace App\Http\Controllers;
use DB;
use Session;
use App\Models\User;
use App\Models\Departments;
use App\Models\Department_Master;
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
        
            return view('CA-TO-DC_Admin.addDepartment');
        } else {
            $validatedData = $request->validate([
                'department_name' => ['required'],
                'department_address' => ['required'],
            ]);

           
            DB::beginTransaction();
            try{

                        $deptName = Departments::on(Session::get('db_conn_name'))->create([
                            'department_name' => $request->department_name,
                            'department_address' => $request->department_address,
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
    public function departmentListCA_TO_DC(Request $request) {
        $data['departments'] = Departments::on(Session::get('db_conn_name'))->get();
        // $data['departments'] = Department_User_Map::on(Session::get('db_conn_name'))
      
                                // ->get();
        // dd($data['deptUsers']);
        return view('CA-TO-DC_Admin.departmentListCA_TO_DC', $data);
    }
}