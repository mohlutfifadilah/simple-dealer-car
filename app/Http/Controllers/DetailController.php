<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Varian;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    //
    public function index(){
        $mobil = Mobil::all();
        $varian = Varian::all();
        return view('semua_mobil', compact('mobil', 'varian'));
    }

    public function show($id){
        $mobil = Mobil::find($id);
        $varian = Varian::where('id_mobil', $mobil->id)->get();
        return view('detail', compact('mobil', 'varian'));
    }
}
