<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class ProfilController extends Controller
{
    public function profil()
    {
        $user = Auth::user();
        return view('profil.profil', compact('user'));
    }
    public function editprofil()
    {
        $user = Auth::user();
        return view('profil.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

    // Validasi form
    $validator = Validator::make($request->all(), [
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:10000', // Maksimum 2MB
    ]);

    // Lakukan validasi
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Mengupdate data pengguna yang tidak berhubungan dengan gambar
    $user->update($request->except('foto'));

    // Mengupload dan menyimpan foto profil jika ada
    if ($request->hasFile('foto')) {
        // Menghapus foto lama jika ada
        if ($user->foto) {
            Storage::delete('public/' . $user->foto);
        }

        // Simpan foto baru
        $fotoPath = $request->file('foto')->store('foto_profil', 'public');

        // Simpan path foto dalam database
        $user->foto = $fotoPath;
        $user->save();
    }

    return redirect()->route('profil')->with('success', 'Profil berhasil diupdate!');
    }
}
