<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ApplicationController extends Controller
{
    public function index(){
        $application = Application::all();
        return view('application.index',compact(['application']));
    }
    public function create(Request $request)
    {
        Application::create($request->except('terms'));
        alert()->success('Berhasil','Woohoo, Data Berhasil Ditambah :D');
        return redirect('/application');
    }

    public function edit(Request $request, $id)
    {
        $application = Application::find($id);
        $application->nama                      = $request->input("md_nama");
        $application->nik                       = $request->input("md_nik");    
        $application->no_telp                   = $request->input("md_no_telp");        
        $application->jenis_kelamin             = $request->input("md_jenis_kelamin");        
        $application->alamat                    = $request->input("md_alamat");        
        $application->klasifikasi_kendaraan     = $request->input("md_klasifikasi_kendaraan");            
        $application->model_kendaraan           = $request->input("md_model_kendaraan");            
        $application->tahun_kendaraan           = $request->input("md_tahun_kendaraan");   
        $application->save(); 
        return redirect('/application');
    }

    public function delete($id)
    {
        $application = Application::find($id);
        $application->delete();
        return redirect('/application');
    }
}
