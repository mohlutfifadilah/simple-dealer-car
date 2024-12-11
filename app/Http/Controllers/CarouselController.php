<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Varian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carousel = Carousel::orderBy('created_at', 'desc')->get();
        return view('admin.carousel.index', compact('carousel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.carousel.carousel_add');
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
        ],
        [
            'gambar.mimes' => 'Format Gambar tidak valid',
            'gambar.max' => 'Gambar maksimal 2 mb',
            'gambar.required' => 'Gambar harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Tambah Carousel', 'type' => 'error']);
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
            $image = $request->file('gambar')->store('carousel');
            $file->move('storage/carousel/', $image);
            $image = str_replace('carousel/', '', $image);
            // if($profil->foto){
            //     unlink(storage_path('app/kegiatan/' . $profil->nama . '/' . $profil->foto));
            //     unlink(public_path('storage/kegiatan/' . $profil->nama . '/' . $profil->foto));
            // }
        } else {
            $image = null;
        }

        Carousel::create([
            'gambar' => $image,
        ]);

        Alert::alert('Berhasil', 'Carousel berhasil ditambahkan ', 'success');
        return redirect()->route('carousel.index')->withSuccess('Carousel berhasil ditambahkan');
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
        $carousel = Carousel::find($id);
        return view('admin.carousel.carousel_edit', compact('carousel'));
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
        $carousel = Carousel::find($id);

        $validator = Validator::make($request->all(), [
            'gambar' => 'mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'gambar.mimes' => 'Format Gambar tidak valid',
            'gambar.max' => 'Gambar maksimal 2 mb',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Edit Carousel', 'type' => 'error']);
        }

        // Cek apakah embed HTML sudah ada di tabel desa
        // if($request->nama != $mobil->nama){
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
            $image = $request->file('gambar')->store('carousel');
            $file->move('storage/carousel/', $image);
            $image = str_replace('carousel/', '', $image);
            if($carousel->gambar){
                unlink(storage_path('app/carousel/' . $carousel->gambar));
                unlink(public_path('storage/carousel/' . $carousel->gambar));
            }
        } else {
            $image = $carousel->gambar;
        }

        $carousel->update([
            'gambar' => $image,
        ]);

        Alert::alert('Berhasil', 'Carousel berhasil diubah ', 'success');
        return redirect()->route('carousel.index')->withSuccess('Carousel berhasil diubah');
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
        $carousel = Carousel::find($id);
        // Hapus semua varian yang terkait dengan id_mobil
        // Varian::where('id_mobil', $id)->delete();
        if($carousel->gambar){
            unlink(storage_path('app/carousel/' . $carousel->gambar));
            unlink(public_path('storage/carousel/' . $carousel->gambar));
          }
        $carousel->delete();

        Alert::alert('Berhasil', 'Carousel berhasil dihapus ', 'success');
        return redirect()->route('carousel.index')->withSuccess('Data Carousel berhasil dihapus');
    }
}
