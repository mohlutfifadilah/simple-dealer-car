<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class GantiPassword extends Controller
{
    public function change($id){
        $user = User::find($id);
        return view('admin.ganti-password', compact('user'));
    }

    public function update(Request $request, $id){

        $user = User::find($id);

        // Buat custom validator rule
        Validator::extend('check_old_password', function ($attribute, $value, $parameters, $validator) use ($user) {
            return Hash::check($value, $user->password);
        });

        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required|check_old_password',
            'newPassword' => 'required|min:8|regex:/[0-9]/',
        ],
        [
            'oldPassword.required' => 'Password Lama harus diisi',
            'oldPassword.check_old_password' => 'Password Lama tidak sama dengan sebelumnya',
            'newPassword.required' => 'Password Baru harus diisi',
            'newPassword.min' => 'Password Baru minimal 8 huruf dan angka',
            'newPassword.regex' => 'Password Baru harus campuran huruf dan angka',
        ]);

        if ($validator->fails()) {
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->withErrors($validator)
                ->withInput()->with(['status' => 'Terjadi Kesalahan', 'title' => 'Ganti Password', 'type' => 'error']);
        }

        if($request->newPassword != $request->password_confirmation){
            Alert::alert('Kesalahan', 'Terjadi Kesalahan ', 'error');
            return redirect()->back()->with('newPassword', 'Password Baru tidak sama');
        }

        $user->update([
            'password' => Hash::make($request->newPassword)
        ]);

        Alert::alert('Berhasil', 'Password berhasil diganti ', 'success');
        return redirect()->route('profil-user-edit', $id)->withSuccess('Password berhasil diganti');
    }
}
