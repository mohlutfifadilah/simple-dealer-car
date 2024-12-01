<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $testimoni = Testimoni::orderBy('created_at', 'desc')->get();
        $bintang = Testimoni::all()->map(function ($item) {
            $item->filled = $item->bintang;
            $item->notFilled = 5 - $item->bintang;
            return $item;
        });
        return view('admin.testimoni.index', compact('testimoni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.testimoni.testimoni_add');
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
            'foto' => 'mimes:jpeg,png,jpg|max:2048|required',
            'nama' => 'required',
            'alamat' => 'required',
            'bintang' => 'required',
            'isi' => 'required',
        ],
        [
            'foto.mimes' => 'Format Foto tidak valid',
            'foto.max' => 'Foto maksimal 2 mb',
            'foto.required' => 'Foto harus diisi',
            'nama.required' => 'Nama Konsumen harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'bintang.required' => 'Bintang harus diisi',
            'isi.required' => 'Isi tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Tambah Testimoni', 'type' => 'error']);
        }

        if ($request->bintang > 5) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withInput()->with('bintang', 'Bintang tidak boleh lebih dari 5');
        }

        // if (Mobil::where('nama', $request->nama)->exists()) {
        //     return redirect()->back()->withInput()->with('nama', 'Nama Mobil sudah digunakan');
        // }

        if ($request->file('foto')) {
            // Ambil ukuran file dalam bytes
            $fileSize = $request->file('foto')->getSize();

            // Periksa apakah ukuran file melebihi batas maksimum (2 MB)
            if ($fileSize > 2 * 1024 * 1024) {
                // File terlalu besar, kembalikan respons dengan pesan kesalahan
                return redirect()->back()->with('foto', 'Ukuran file maksimal 2 mb');
            }
            $file = $request->file('foto');
            $image = $request->file('foto')->store('testimoni/');
            $file->move('storage/testimoni/', $image);
            $image = str_replace('testimoni/', '', $image);
            // if($profil->foto){
            //     unlink(storage_path('app/kegiatan/' . $profil->nama . '/' . $profil->foto));
            //     unlink(public_path('storage/kegiatan/' . $profil->nama . '/' . $profil->foto));
            // }
        } else {
            $image = null;
        }

        Testimoni::create([
            'foto' => $image,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'bintang' => intval($request->bintang),
            'isi' => $request->isi,
        ]);

        Alert::alert('Berhasil', 'Testimoni berhasil ditambahkan ', 'success');
        return redirect()->route('testimoni.index')->withSuccess('Testimoni berhasil ditambahkan');
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
        $testimoni = Testimoni::find($id);
        return view('admin.testimoni.testimoni_edit', compact('testimoni'));
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
        $testimoni = Testimoni::find($id);

        $validator = Validator::make($request->all(), [
            'foto' => 'mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required',
            'alamat' => 'required',
            'bintang' => 'required',
            'isi' => 'required',
        ],
        [
            'foto.mimes' => 'Format Foto tidak valid',
            'foto.max' => 'Foto maksimal 2 mb',
            'nama.required' => 'Nama Konsumen harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'bintang.required' => 'Bintang harus diisi',
            'isi.required' => 'Isi tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Edit Testimoni', 'type' => 'error']);
        }

        if ($request->bintang > 5) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withInput()->with('bintang', 'Bintang tidak boleh lebih dari 5');
        }

        if ($request->file('foto')) {
            // Ambil ukuran file dalam bytes
            $fileSize = $request->file('foto')->getSize();

            // Periksa apakah ukuran file melebihi batas maksimum (2 MB)
            if ($fileSize > 2 * 1024 * 1024) {
                // File terlalu besar, kembalikan respons dengan pesan kesalahan
                return redirect()->back()->with('foto', 'Ukuran file maksimal 2 mb');
            }
            $file = $request->file('foto');
            $image = $request->file('foto')->store('testimoni/');
            $file->move('storage/testimoni/', $image);
            $image = str_replace('testimoni/', '', $image);
            if($testimoni->foto){
                unlink(storage_path('app/testimoni/' . $testimoni->foto));
                unlink(public_path('storage/testimoni/' . $testimoni->foto));
            }
        } else {
            $image = $testimoni->foto;
        }

        $testimoni->update([
            'foto' => $image,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'bintang' => intval($request->bintang),
            'isi' => $request->isi,
        ]);

        Alert::alert('Berhasil', 'Testimoni berhasil diubah ', 'success');
        return redirect()->route('testimoni.index')->withSuccess('Testimoni berhasil diubah');
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
        $testimoni = Testimoni::find($id);
        // Hapus semua varian yang terkait dengan id_mobil
        // Varian::where('id_mobil', $id)->delete();
        if($testimoni->foto){
            unlink(storage_path('app/testimoni/' . $testimoni->foto));
            unlink(public_path('storage/testimoni/' . $testimoni->foto));
          }
        $testimoni->delete();

        Alert::alert('Berhasil', 'Testimoni berhasil dihapus ', 'success');
        return redirect()->route('testimoni.index')->withSuccess('Data Testimoni berhasil dihapus');
    }
}
