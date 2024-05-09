<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportDocsModel;
use Auth, Session;
use App\Models\District_User_Map;
use Illuminate\Support\Facades\Storage;

class ReportDocsController extends Controller
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

    public function uploadReportDocs(Request $request){
        if ($request->isMethod('get')) {
            return view('hod-upload-report-docs');
        } else {
            $request->validate([
                'title' => 'required|string',
                'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5000',
            ]);
    
            if ($request->hasFile('file')) {
                $file = $request->file('file');
    
                $path = $file->store('public/reportDocs');

                $filename = basename($path);
                
                $scheme = ReportDocsModel::on(Session::get('db_conn_name'))->create([
                    'subject' => $request->title,
                    'filename' => $filename,
                    'uploaded_by' => Auth::user()->id,
                    'ip_address' => $request->ip()  
                ]);

                // $path2 = storage_path('app/public/notifications' . $filename);
                return redirect()->route('hod_show_report_docs')->with('alert-success', 'Document Uploaded Successfully');

                // return "File uploaded successfully. Path: $path2";
            } else {
                return redirect()->route('uploadReportDocs')->with('alert-failed', 'Something Went Wrong!');

            }
        }
    }

    public function hod_show_report_docs(Request $request){
        $data['reportDocs'] = ReportDocsModel::on(Session::get('db_conn_name'))
            ->where('uploaded_by', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('hod-report-documents', $data);
    }

    public function ca_to_dc_show_report_docs(Request $request){
        $data['reportDocs'] = ReportDocsModel::on(Session::get('db_conn_name'))->orderBy('created_at', 'desc')->paginate(10);
        return view('CA-TO-DC_Admin.view-report-documents', $data);
    }

    public function deleteReportDocument(Request $request, $id){
        $reportDocument = ReportDocsModel::on(Session::get('db_conn_name'))->find($id);
        if ($reportDocument) {
            $reportDocument->delete();
            return redirect()->route('hod_show_report_docs')->with('alert-success', 'Document Deleted Successfully');
        } else {
            return redirect()->route('hod_show_report_docs')->with('alert-failed', 'Something Went Wrong!');
        }
    }
}