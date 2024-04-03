<?php

namespace App\Http\Controllers;

use App\Models\tugas;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $tugas = Tugas::where('status', '!=', 'Udahdah')->get();
        $users = User::orderBy('skor', 'desc')->take(3)->get();

        return view('admin.dashboard', compact('tugas', 'users'));
    }

    public function hapus($id)
    {
        $hapus = Tugas::find($id)->delete();
        return redirect()->back();
    }

    public function tasklist()
    {
        $tugas = Tugas::whereNotIn('status', ['Udahdah'])->get();

        return view('admin.tasklist', compact('tugas'));
    }
    public function ubah($tugasId)
    {
        $tugas = Tugas::find($tugasId);
        $users = User::all();
        $admins = User::where('role', 'admin')->get();

        if (!$tugas) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan.');
        }

        return view('admin.ubah', compact('tugas', 'users', 'admins'));
    }
    public function ubahdata(Request $request ,$tugasId)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'selesai' => 'required|date',
            'skor' => 'required|numeric|max:255',
            'pengurangan_skor' => 'required|numeric|max:255',
            'user_id' => 'required',
            'admin_id' => 'required',
        ]);

        $simpan = Tugas::find($tugasId);
        $simpan->judul = $request->judul;
        $simpan->deskripsi = $request->deskripsi;
        $simpan->selesai = $request->selesai;
        $simpan->skor = $request->skor;
        $simpan->pengurangan_skor = $request->pengurangan_skor;
        $simpan->user_id = $request->user_id;
        $simpan->admin_id = $request->admin_id;
        $simpan->save();
        return redirect()->route('admin.dashboard')->with('success', 'Tugas berhasil diupdate!');
    }
    public function history()
    {
        $tugasSelesai = Tugas::where('status', 'Udahdah')->get();
        return view('admin.history', compact('tugasSelesai'));
    }
    public function leaderboard()
    {
        $users = User::orderBy('skor', 'desc')->get();
        return view('admin.leaderboard', compact('users'));
    }
    public function Score(User $user)
    {
        return view('admin.edit-skor', compact('user'));
    }
    public function updateScore(Request $request, User $user)
    {
        if (auth()->user()->role === 'admin') {
            // Update skor pengguna yang dipilih
            $user->update(['skor' => $request->skor]);

            return redirect()->route('admin.dashboard')->with('success', 'Skor pengguna berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
    }

}
