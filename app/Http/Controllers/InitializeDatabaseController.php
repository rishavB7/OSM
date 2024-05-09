<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Session, DB;
use App\Models\District_Master;
use App\Models\Notifications;
use App\Models\ReportDocsModel;
use App\Models\Scheme_Supervisor_Map;
use App\Models\SchemeProgress;
use App\Models\Schemes;

class InitializeDatabaseController extends Controller
{
    public function initializeDatabase(Request $request){
        if ($request->isMethod('get')) {
            $data['districts'] = District_Master::get();
            return view('Master_Admin.initialize-database', $data);
        } else {
            $validatedData = $request->validate([
                'district' => ['required', 'string', 'max:255']
            ]);

            if($request->district == 'West Karbi Anglong'
            || $request->district == 'South Salmara'
            || $request->district == 'South Salmara Mancachar'
            || $request->district == 'North Salmara'
            || $request->district == 'Kamrup Metro'
            || $request->district == 'Kamrup Metropolitan'
            || $request->district == 'WEST KARBI ANGLONG'
            || $request->district == 'SOUTH SALMARA'       
            || $request->district == 'SOUTH SALMARA MANCACHAR'       
            || $request->district == 'NORTH SALMARA'
            || $request->district == 'KAMRUP METRO'
            || $request->district == 'KAMRUP METROPOLITAN'
            ){
                $conn_name = 'conn_'.strtolower(str_replace(' ', '_', $request->district));
            }else{
                $conn_name = 'conn_'.strtolower( $request->district);
            }
            DB::beginTransaction($conn_name);
            try{
                Notifications::on($conn_name)->truncate();
                ReportDocsModel::on($conn_name)->truncate();
                Scheme_Supervisor_Map::on($conn_name)->truncate();
                SchemeProgress::on($conn_name)->truncate();
                Schemes::on($conn_name)->truncate();

                DB::commit($conn_name);
                return redirect()->route('initializeDatabase')->with('alert-success', 'Database Initialized Successfully');
            } catch (Exception $e) {
                DB::rollBack($conn_name);
    
                return redirect()->route('initializeDatabase')->with('alert-failed', 'Something Went Wrong');
                
            }
        }
    }
}