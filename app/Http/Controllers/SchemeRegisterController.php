<?php

namespace App\Http\Controllers;

use App\Models\Schemes;
use Illuminate\Http\Request;
use Auth,Session;
use App\Models\District_User_Map;

class SchemeRegisterController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;

            $district= District_User_Map::with('district_master')->where('user_id', Auth::user()->id)->first();

            if($district->district_master->district == 'West Karbi Anglong'
            || $district->district_master->district == 'South Salmara'
            || $district->district_master->district == 'North Salmara'
            || $district->district_master->district == 'Kamrup Metro'
            || $district->district_master->district == 'WEST KARBI ANGLONG'
            || $district->district_master->district == 'SOUTH SALMARA'
            || $district->district_master->district == 'NORTH SALMARA'
            || $district->district_master->district == 'KAMRUP METRO'
            ){
                Session::put('db_conn_name', 'conn_'.strtolower(str_replace(' ', '', $district->district_master->district)));
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

            $scheme = Schemes::on(Session::get('db_conn_name'))->create([
                'scheme_name' => $request->scheme_name,
                'scheme_description' => $request->scheme_description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 1,
                
            ]);

            return redirect()->route('dashboard')->with('alert-success', 'Scheme Created Successfully');
        }
    }

    public function listScheme(Request $request) {
        $data['schemes'] = Schemes::on(Session::get('db_conn_name'))->get();
        return view('HOD_Admin.listScheme', $data);
    }
}
