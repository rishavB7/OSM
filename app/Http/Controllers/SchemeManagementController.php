<?php

namespace App\Http\Controllers;

use App\Models\Schemes;
use Illuminate\Http\Request;
use Auth,Session;
use App\Models\District_User_Map;
use App\Models\Scheme_Implementation;

class SchemeManagementController extends Controller
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

    // public function schemeImp(Request $request) {
    //     if($request->isMethod('get')) {
    //         return view('HOD_Admin.SchemeImp');
    //     } else {
    //         $validatedData = $request->validate([
    //             'scheme_name' => ['required','string','max:255'],
    //             'scheme_description' => ['required' ,'string', 'max:255'],
    //             'start_date' => ['required'],
    //             'end_date' => ['required'],
    //             'date_of_reporting' => ['required'],
    //         ]);

    //         $scheme = Scheme_Implementation::on(Session::get('db_conn_name'))->create([
    //             'date_of_reporting' => $request->date_of_reporting,
    //             'status' => 1,
                
    //         ]);

    //         return redirect()->route('dashboard')->with('alert-success', 'Scheme Implemented Successfully');
    //     }
    // }

    // public function apply($schemeId)
    // {
    //     $scheme = Schemes::on(Session::get('db_conn_name'))->where('id', $schemeId)->first();
    //     // Use 'first' instead of 'find' to fetch the scheme from the database
    
    //     if (!$scheme) {
    //         return redirect()->route('listScheme')->with('error', 'Scheme not found.');
    //     }
    
    //     $scheme->status = '1'; // Set status to 'Active'
    //     $scheme->save();
    
    //     return redirect()->route('listScheme')->with('success', 'Scheme status updated to active.');
    // }
    

}
