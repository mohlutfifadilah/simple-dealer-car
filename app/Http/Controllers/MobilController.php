<?php

namespace App\Http\Controllers;

use App\Models\InfoMobil;
use App\Models\Mobil;
use App\Models\Varian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mobil = Mobil::orderBy('created_at', 'desc')->get();
        return view('admin.mobil.index', compact('mobil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.mobil.mobil_add');
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
            'brosur' => 'mimes:jpeg,png,jpg,pdf|max:2048',
            'nama' => 'required',
            // 'warna' => 'required',
            // 'detail_warna' => 'required',
        ],
        [
            'brosur.mimes' => 'Format File tidak valid',
            'brosur.max' => 'File maksimal 2 mb',
            'nama.required' => 'Nama harus diisi',
            // 'warna.required' => 'Warna harus diisi',
            // 'detail_warna.required' => 'Detail Warna harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Tambah Mobil', 'type' => 'error']);
        }

        if (Mobil::where('nama', $request->nama)->exists()) {
            return redirect()->back()->withInput()->with('nama', 'Nama Mobil sudah digunakan');
        }

        if ($request->file('brosur')) {
            // Ambil ukuran file dalam bytes
            $fileSize = $request->file('brosur')->getSize();

            // Periksa apakah ukuran file melebihi batas maksimum (2 MB)
            if ($fileSize > 2 * 1024 * 1024) {
                // File terlalu besar, kembalikan respons dengan pesan kesalahan
                return redirect()->back()->with('brosur', 'Ukuran file maksimal 2 mb');
            }
            $file = $request->file('brosur');
            $image = $request->file('brosur')->store('brosur');
            $file->move('storage/brosur/', $image);
            $image = str_replace('brosur/', '', $image);
            // if($profil->foto){
            //     unlink(storage_path('app/kegiatan/' . $profil->nama . '/' . $profil->foto));
            //     unlink(public_path('storage/kegiatan/' . $profil->nama . '/' . $profil->foto));
            // }
        } else {
            $image = '';
        }

        Mobil::create([
            'brosur' => $image,
            'nama' => $request->nama,
            // 'warna' => $request->warna,
            // 'detail_warna' => $request->detail_warna,
        ]);

        Alert::alert('Berhasil', 'Mobil berhasil ditambahkan ', 'success');
        return redirect()->route('mobil.index')->withSuccess('Mobil berhasil ditambahkan');
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
        $mobil = Mobil::find($id);
        return view('admin.mobil.mobil_edit', compact('mobil'));
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
        $mobil = Mobil::find($id);

        $validator = Validator::make($request->all(), [
            'brosur' => 'mimes:jpeg,png,jpg,pdf|max:2048',
            'nama' => 'required',
            // 'warna' => 'required',
            // 'detail_warna' => 'required',
        ],
        [
            'brosur.mimes' => 'Format File tidak valid',
            'brosur.max' => 'File maksimal 2 mb',
            'nama.required' => 'Nama harus diisi',
            // 'warna.required' => 'Warna harus diisi',
            // 'detail_warna.required' => 'Detail Warna harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Edit Mobil', 'type' => 'error']);
        }

        // Cek apakah embed HTML sudah ada di tabel desa
        if($request->nama != $mobil->nama){
            if (Mobil::where('nama', $request->nama)->exists()) {
                Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
                return redirect()->back()->withInput()->with('nama', 'Nama Mobil sudah digunakan!');
            }
        }

        if ($request->file('brosur')) {
            // Ambil ukuran file dalam bytes
            $fileSize = $request->file('brosur')->getSize();

            // Periksa apakah ukuran file melebihi batas maksimum (2 MB)
            if ($fileSize > 2 * 1024 * 1024) {
                // File terlalu besar, kembalikan respons dengan pesan kesalahan
                return redirect()->back()->with('brosur', 'Ukuran file maksimal 2 mb');
            }
            $file = $request->file('brosur');
            $image = $request->file('brosur')->store('brosur');
            $file->move('storage/brosur/', $image);
            $image = str_replace('brosur/', '', $image);
            if($mobil->brosur){
                unlink(storage_path('app/brosur/' . $mobil->brosur));
                unlink(public_path('storage/brosur/' . $mobil->brosur));
            }
        } else {
            $image = $mobil->brosur;
        }

        $mobil->update([
            'brosur' => $image,
            'nama' => $request->nama,
            // 'warna' => $request->warna,
            // 'detail_warna' => $request->detail_warna,
        ]);

        Alert::alert('Berhasil', 'Mobil berhasil diubah ', 'success');
        return redirect()->route('mobil.index')->withSuccess('Mobil berhasil diubah');
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
        $mobil = Mobil::find($id);
        // Hapus semua varian yang terkait dengan id_mobil
        Varian::where('id_mobil', $id)->delete();
        InfoMobil::where('id_mobil', $id)->delete();
        if($mobil->brosur){
            unlink(storage_path('app/brosur/' . $mobil->brosur));
            unlink(public_path('storage/brosur/' . $mobil->brosur));
          }
        $mobil->delete();

        Alert::alert('Berhasil', 'Mobil berhasil dihapus ', 'success');
        return redirect()->route('mobil.index')->withSuccess('Data Mobil berhasil dihapus');
    }
}
