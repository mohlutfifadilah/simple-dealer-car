<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Varian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class VarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mobil = Mobil::get()->count();
        if($mobil < 1){
            Alert::alert('Gagal', 'Tambahkan mobil terlebih dahulu ', 'error');
            return redirect()->back()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Tambah Mobil', 'type' => 'error']);
        } else {
            $varian = Varian::orderBy('created_at', 'desc')->get();
            return view('admin.varian.index', compact('varian'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $mobil = Mobil::all();
        return view('admin.varian.varian_add', compact('mobil'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd(intval($request->input('harga')));
        // Hapus format non-angka di Laravel (jika input belum bersih)
        $validator = Validator::make($request->all(), [
            // 'role' => 'required',
            'mobil' => 'required',
            'tipe' => 'required',
            'harga' => 'required',
        ],
        [
            // 'role.required' => 'Role harus diisi',
            'mobil.required' => 'Mobil harus diisi',
            'tipe.required' => 'Tipe harus diisi',
            'harga.required' => 'Harga harus diisi',
            // 'password.regex' => 'Password harus campuran huruf dan angka',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
            ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Tambah Varian', 'type' => 'error']);
        }

        // if (Varian::where('tipe', $request->tipe)->exists()) {
        //     return redirect()->back()->withInput()->with('tipe', 'Tipe sudah digunakan');
        // }

        $cleanedAmount = preg_replace('/[^0-9]/', '', $request->harga);

        // $jenjang = Jenjang::where('nama_jenjang', '=', $request->jenjang)->first();
        Varian::create([
            // 'foto' => null,
            'id_mobil' => intval($request->mobil),
            'tipe' => $request->tipe,
            'harga' => intval($cleanedAmount)
        ]);

        Alert::alert('Berhasil', 'Varian berhasil ditambahkan ', 'success');
        return redirect()->route('varian.index')->withSuccess('Varian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $varian = Varian::find($id);
        $mobil = Mobil::all();
        return view('admin.varian.varian_edit', compact('varian', 'mobil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $varian = Varian::find($id);

        $validator = Validator::make($request->all(), [
            'mobil' => 'required',
            'tipe' => 'required',
            'harga' => 'required',
        ],
        [
            'mobil.required' => 'Mobil harus diisi',
            'tipe.required' => 'Tipe harus diisi',
            'harga.required' => 'Harga harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Edit Varian', 'type' => 'error']);
        }

        // Cek apakah embed HTML sudah ada di tabel desa
        // if($request->tipe != $varian->tipe){
        //     if (Varian::where('tipe', $request->tipe)->exists()) {
        //         Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
        //         return redirect()->back()->withInput()->with('tipe', 'Tipe sudah digunakan!');
        //     }
        // }
        $cleanedAmount = preg_replace('/[^0-9]/', '', $request->harga);
        $varian->update([
            'id_mobil' => intval($request->mobil),
            'tipe' => $request->tipe,
            'harga' => intval($cleanedAmount),
            // 'password' => Hash::make($request->password)
        ]);

        Alert::alert('Berhasil', 'Varian berhasil diedit ', 'success');
        return redirect()->route('varian.index')->withSuccess('Varian berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $varian = Varian::find($id);
        // if($varian->foto){
        //     unlink(storage_path('app/profil/' . $varian->foto));
        //     unlink(public_path('storage/profil/' . $varian->foto));
        //   }
        $varian->delete();

        Alert::alert('Berhasil', 'Varian berhasil dihapus ', 'success');
        return redirect()->route('varian.index')->withSuccess('Data Varian berhasil dihapus');
    }
}
