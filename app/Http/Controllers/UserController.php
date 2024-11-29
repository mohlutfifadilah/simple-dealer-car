<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::orderBy('created_at', 'desc')->get();
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.user_add');
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
            // 'role' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ],
        [
            // 'role.required' => 'Role harus diisi',
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 huruf karakter',
            // 'password.regex' => 'Password harus campuran huruf dan angka',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Tambah Pengguna', 'type' => 'error']);
        }

        // Validasi apakah input email valid
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->with('email', 'Format Email tidak valid');
        }

        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withInput()->with('email', 'Email sudah digunakan');
        }

        // $jenjang = Jenjang::where('nama_jenjang', '=', $request->jenjang)->first();
        User::create([
            // 'foto' => null,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->email)
        ]);

        Alert::alert('Berhasil', 'Pengguna berhasil ditambahkan ', 'success');
        return redirect()->route('user.index')->withSuccess('Pengguna berhasil ditambahkan');
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
        return view('admin.user.user_edit', compact('user'));
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
            // 'role' => 'required',
            'nama' => 'required',
            'email' => 'required',
            // 'password' => 'required|min:8',
        ],
        [
            // 'role.required' => 'Role harus diisi',
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            // 'password.required' => 'Password harus diisi',
            // 'password.min' => 'Password minimal 8 huruf karakter',
            // 'password.regex' => 'Password harus campuran huruf dan angka',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Edit Pengguna', 'type' => 'error']);
        }

        // Validasi apakah input email valid
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->with('email', 'Format Email tidak valid');
        }

        // Cek apakah embed HTML sudah ada di tabel desa
        if($request->email != $user->email){
            if (User::where('email', $request->email)->exists()) {
                Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
                return redirect()->back()->withInput()->with('email', 'Email sudah digunakan!');
            }
        }

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            // 'password' => Hash::make($request->password)
        ]);

        Alert::alert('Berhasil', 'Pengguna berhasil diedit ', 'success');
        return redirect()->route('user.index')->withSuccess('Pengguna berhasil diedit');
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
        $user = User::find($id);
        // if($user->foto){
        //     unlink(storage_path('app/profil/' . $user->foto));
        //     unlink(public_path('storage/profil/' . $user->foto));
        //   }
        $user->delete();

        Alert::alert('Berhasil', 'Pengguna berhasil dihapus ', 'success');
        return redirect()->route('user.index')->withSuccess('Data Pengguna berhasil dihapus');
    }
}
