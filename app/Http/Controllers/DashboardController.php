<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\District_User_Map;
use Session;
class DashboardController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {

            if(Auth::user()->role == 2 || Auth::user()->role == 4 || Auth::user()->role == 5 || Auth::user()->role == 6){
                $this->id = Auth::user()->id;
                $election_district= District_User_Map::with('district_master')->where('user_id', Auth::user()->id)->first();


                if($election_district->district_master->district == 'West Karbi Anglong'
                || $election_district->district_master->district == 'South Salmara'
                || $election_district->district_master->district == 'North Salmara'
                || $election_district->district_master->district == 'Kamrup Metro'
                
                || $election_district->district_master->district == 'WEST KARBI ANGLONG'
                || $election_district->district_master->district == 'SOUTH SALMARA'
                || $election_district->district_master->district == 'NORTH SALMARA'
                // || $election_district->district_master->election_district == 'SOUTH SALMARA MANKACHAR'
                // || $election_district->district_master->election_district == 'NORTH SALMARA MANKACHAR'
                // || $election_district->district_master->election_district == 'South Salmara Mankachar'
                // || $election_district->district_master->election_district == 'North Salmara Mankachar'
                || $election_district->district_master->district == 'KAMRUP METRO'
                ){
                    Session::put('db_conn_name', 'conn_'.strtolower(str_replace(' ', '', $election_district->district_master->district)));
                }else{

                    Session::put('db_conn_name', 'conn_'.strtolower($election_district->district_master->district));
                }
                Session::put('district_unique_code', $election_district->district_master->unique_code);
            }
            return $next($request);
        });
    }
    public function index() {
        if(Auth::user()->role == 1){
            return view('Master_Admin.dashboard');
    
        }elseif(Auth::user()->role == 2){

            return view('District_Admin.dashboard');
        }elseif(Auth::user()->role == 3){

            return view('HOD_Admin.dashboard');
        }elseif(Auth::user()->role == 4){

            return view('CA-TO-DC_Admin.dashboard');
        }elseif(Auth::user()->role == 5){

            return view('CEO_ZP_Admin.dashboard');
        }
        else{
            return view('DDC_Admin.dashboard');
        }
    }
}

