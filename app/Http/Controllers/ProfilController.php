<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = User::find($id);
        return view('admin.profil-edit', compact('user'));
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
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'no' => 'required',
        ],
        [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'no.required' => 'No Whatsapp harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->route('profil-user-edit', $id)->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Edit Akun', 'type' => 'error']);
        }

        // Validasi apakah input email valid
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->route('profil-user-edit', $id)->with('email', 'Format Email tidak valid');
        }

        // Cek apakah embed HTML sudah ada di tabel desa
        if($request->email != $user->email){
            if (User::where('email', $request->email)->exists()) {
                Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
                return redirect()->back()->withInput()->with('email', 'Email sudah digunakan!');
            }
        }

        // Cek apakah embed HTML sudah ada di tabel desa
        if($request->no != $user->no){
            if (User::where('no', $request->no)->exists()) {
                Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
                return redirect()->back()->withInput()->with('no', 'No Whatsapp sudah digunakan!');
            }
        }

        // if ($request->file('foto')) {
        //     // Ambil ukuran file dalam bytes
        //     $fileSize = $request->file('foto')->getSize();

        //     // Periksa apakah ukuran file melebihi batas maksimum (2 MB)
        //     if ($fileSize > 2 * 1024 * 1024) {
        //         // File terlalu besar, kembalikan respons dengan pesan kesalahan
        //         return redirect()->back()->with('foto', 'Ukuran file maksimal 2 mb');
        //     }
        //     $file = $request->file('foto');
        //     $image = $request->file('foto')->store('profil');
        //     $file->move('storage/profil/', $image);
        //     $image = str_replace('profil/', '', $image);
        //     if($user->foto){
        //         unlink(storage_path('app/profil/' . $user->foto));
        //         unlink(public_path('storage/profil/' . $user->foto));
        //     }
        // } else {
        //     $image = $user->foto;
        // }
        // dd($request->no);
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no' => $request->no,
        ]);

        Alert::alert('Berhasil', 'Akun berhasil diedit ', 'success');
        return redirect()->route('profil-user-edit', $id)->withSuccess('Akun berhasil diedit');
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
    }
}
