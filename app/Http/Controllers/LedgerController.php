<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function index(){
        $data['ledger'] = Ledger::all();
        return view('ledger.index', $data);
    }
    
    public function create(){

    }
    
    public function edit(){

    }
    
    public function delete(){

    }
    
}
