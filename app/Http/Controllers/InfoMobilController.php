<?php

namespace App\Http\Controllers;

use App\Models\InfoMobil;
use App\Models\Mobil;
use App\Models\Varian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class InfoMobilController extends Controller
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
            $detail = InfoMobil::orderBy('created_at', 'desc')->get();
            return view('admin.info_mobil.index', compact('detail'));
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
        return view('admin.info_mobil.info_mobil_add', compact('mobil'));
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
        $validator = Validator::make($request->all(), [
            'gambar' => 'mimes:jpeg,png,jpg|max:2048|required',
            'mobil' => 'required',
            'warna' => 'required',
            'kode_warna' => 'required',
        ],
        [
            'gambar.mimes' => 'Format Gambar tidak valid',
            'gambar.max' => 'Gambar maksimal 2 mb',
            'gambar.required' => 'Gambar harus diisi',
            'mobil.required' => 'Mobil harus diisi',
            'warna.required' => 'Warna harus diisi',
            'kode_warna.required' => 'Kode Warna harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Tambah Detail', 'type' => 'error']);
        }

        // if (Mobil::where('nama', $request->nama)->exists()) {
        //     return redirect()->back()->withInput()->with('nama', 'Nama Mobil sudah digunakan');
        // }

        if ($request->file('gambar')) {
            // Ambil ukuran file dalam bytes
            $fileSize = $request->file('gambar')->getSize();

            // Periksa apakah ukuran file melebihi batas maksimum (2 MB)
            if ($fileSize > 2 * 1024 * 1024) {
                // File terlalu besar, kembalikan respons dengan pesan kesalahan
                return redirect()->back()->with('gambar', 'Ukuran file maksimal 2 mb');
            }
            $file = $request->file('gambar');
            $image = $request->file('gambar')->store('mobil');
            $file->move('storage/mobil/', $image);
            $image = str_replace('mobil/', '', $image);
            // if($profil->foto){
            //     unlink(storage_path('app/kegiatan/' . $profil->nama . '/' . $profil->foto));
            //     unlink(public_path('storage/kegiatan/' . $profil->nama . '/' . $profil->foto));
            // }
        } else {
            $image = null;
        }

        InfoMobil::create([
            'id_mobil' => intval($request->mobil),
            'gambar' => $image,
            'warna' => $request->warna,
            'kode_warna' => $request->kode_warna,
        ]);

        Alert::alert('Berhasil', 'Detail berhasil ditambahkan ', 'success');
        return redirect()->route('info_mobil.index')->withSuccess('Detail berhasil ditambahkan');
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
        $info_mobil = InfoMobil::find($id);
        $mobil = Mobil::all();
        return view('admin.info_mobil.info_mobil_edit', compact('info_mobil', 'mobil'));
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
        $info_mobil = InfoMobil::find($id);

        $validator = Validator::make($request->all(), [
            'gambar' => 'mimes:jpeg,png,jpg|max:2048',
            'mobil' => 'required',
            'warna' => 'required',
            'kode_warna' => 'required',
        ],
        [
            'gambar.mimes' => 'Format Gambar tidak valid',
            'gambar.max' => 'Gambar maksimal 2 mb',
            'mobil.required' => 'Mobil harus diisi',
            'warna.required' => 'Warna harus diisi',
            'kode_warna.required' => 'Kode Warna harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Edit Detail', 'type' => 'error']);
        }

        // Cek apakah embed HTML sudah ada di tabel desa
        // if($request->nama != $info_mobil->nama){
        //     if (Mobil::where('nama', $request->nama)->exists()) {
        //         Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
        //         return redirect()->back()->withInput()->with('nama', 'Nama Mobil sudah digunakan!');
        //     }
        // }

        if ($request->file('gambar')) {
            // Ambil ukuran file dalam bytes
            $fileSize = $request->file('gambar')->getSize();

            // Periksa apakah ukuran file melebihi batas maksimum (2 MB)
            if ($fileSize > 2 * 1024 * 1024) {
                // File terlalu besar, kembalikan respons dengan pesan kesalahan
                return redirect()->back()->with('gambar', 'Ukuran file maksimal 2 mb');
            }
            $file = $request->file('gambar');
            $image = $request->file('gambar')->store('mobil/');
            $file->move('storage/mobil/', $image);
            $image = str_replace('mobil/', '', $image);
            if($info_mobil->gambar){
                unlink(storage_path('app/mobil/' . $info_mobil->gambar));
                unlink(public_path('storage/mobil/' . $info_mobil->gambar));
            }
        } else {
            $image = $info_mobil->gambar;
        }

        $info_mobil->update([
            'id_mobil' => intval($request->mobil),
            'gambar' => $image,
            'warna' => $request->warna,
            'kode_warna' => $request->kode_warna,
        ]);

        Alert::alert('Berhasil', 'Detail berhasil diubah ', 'success');
        return redirect()->route('info_mobil.index')->withSuccess('Detail berhasil diubah');
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
        $info_mobil = InfoMobil::find($id);
        // Hapus semua varian yang terkait dengan id_mobil
        // Varian::where('id_mobil', $id)->delete();
        if($info_mobil->gambar){
            unlink(storage_path('app/mobil/' . $info_mobil->gambar));
            unlink(public_path('storage/mobil/' . $info_mobil->gambar));
          }
        $info_mobil->delete();

        Alert::alert('Berhasil', 'Detail berhasil dihapus ', 'success');
        return redirect()->route('info_mobil.index')->withSuccess('Data Detail berhasil dihapus');
    }
}
