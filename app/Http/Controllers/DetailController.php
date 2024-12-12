<?php

namespace App\Http\Controllers;

use App\Models\InfoMobil;
use App\Models\Mobil;
use App\Models\Varian;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    //
    public function index(){
        $varianIds = Varian::pluck('id_mobil'); // Ambil semua id_mobil dari tabel varian
        $mobil = Mobil::whereIn('id', $varianIds)->get(); // Ambil mobil yang id-nya ada di dalam $varianIds
        $varian = Varian::all();
        return view('semua_mobil', compact('mobil', 'varian'));
    }

    public function show($id){
        $mobil = Mobil::find($id);
        $info = InfoMobil::where('id_mobil', $id)->get();
        $varian = Varian::where('id_mobil', $mobil->id)->get();
        $warna = InfoMobil::where('id_mobil', $id)->get();
        return view('detail', compact('mobil', 'info', 'varian', 'warna'));
    }
}
