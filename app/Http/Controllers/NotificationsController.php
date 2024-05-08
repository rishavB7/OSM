<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Notifications;
use Auth, Session;
use App\Models\District_User_Map;
use Illuminate\Support\Facades\Storage;

class NotificationsController extends Controller
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

    public function ca_to_dc_notifications(Request $request){
        $data['notifications'] = Notifications::on(Session::get('db_conn_name'))->orderBy('created_at', 'desc')->paginate(10);
        return view('CA-TO-DC_Admin.notifications', $data);
    }
    
    public function createNotification(Request $request){
        if ($request->isMethod('get')) {
            return view('CA-TO-DC_Admin.create-notifications');
        } else {
            $request->validate([
                'title' => 'required|string',
                'file' => 'required|file|mimes:pdf|max:5000',
            ]);
    
            if ($request->hasFile('file')) {
                $file = $request->file('file');
    
                $path = $file->store('public/notifications');

                $filename = basename($path);
                
                $scheme = Notifications::on(Session::get('db_conn_name'))->create([
                    'title' => $request->title,
                    'filename' => $filename   
                ]);

                // $path2 = storage_path('app/public/notifications' . $filename);
                return redirect()->route('ca_to_dc_notifications')->with('alert-success', 'Notification Created Successfully');

                // return "File uploaded successfully. Path: $path2";
            } else {
                return redirect()->route('ca_to_dc_notifications')->with('alert-failed', 'Something Went Wrong!');

            }
        }
    }

    public function delete_notification(Request $request, $id){

        $notification = Notifications::on(Session::get('db_conn_name'))->find($id);
        if ($notification) {
            $notification->delete();
            return redirect()->route('ca_to_dc_notifications')->with('alert-success', 'Notification Deleted Successfully');
        } else {
            return redirect()->route('ca_to_dc_notifications')->with('alert-failed', 'Something Went Wrong!');
        }
    }

    public function notices(Request $request){
        $data['notices'] = Notifications::on(Session::get('db_conn_name'))->orderBy('created_at', 'desc')->take(10)->get();
        return view('notifications', $data);
    }

}