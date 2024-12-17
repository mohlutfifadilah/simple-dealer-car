<?php

namespace App\Http\Controllers;

use App\Models\InfoMobil;
use App\Models\Mobil;
use App\Models\User;
use App\Models\Varian;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    //
    public function index(){
        $varianIds = Varian::pluck('id_mobil'); // Ambil semua id_mobil dari tabel varian
        $mobil = Mobil::whereIn('id', $varianIds)->get(); // Ambil mobil yang id-nya ada di dalam $varianIds
        $varian = Varian::all();
        $user = User::find(1);
        $no = $user->no;
        return view('semua_mobil', compact('mobil', 'varian', 'no'));
    }

    public function show($id){
        $mobil = Mobil::find($id);
        $info = InfoMobil::where('id_mobil', $id)->get();
        $varian = Varian::where('id_mobil', $mobil->id)->get();
        $warna = InfoMobil::where('id_mobil', $id)->get();
        $user = User::find(1);
        $no = $user->no;
        return view('detail', compact('mobil', 'info', 'varian', 'warna', 'no'));
    }
}
