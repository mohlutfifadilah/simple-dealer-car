<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    //
    public function show($id){
        $mobil = Mobil::find($id);
        return view('detail', compact('mobil'));
    }
}
