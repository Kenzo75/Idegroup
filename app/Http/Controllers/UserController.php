<?php

namespace App\Http\Controllers;

use App\Models\tugas;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JadwalPiket;
use Carbon\Carbon;

class UserController extends Controller
{
    public function dashboard()
    {
        // Dapatkan nama hari saat ini dalam format yang diinginkan
        $hariIni = now()->translatedFormat('l');

        // Inisialisasi variabel untuk menyimpan data jadwal piket berdasarkan hari
        $piketHariIni = [];

        // Atur variabel data jadwal piket berdasarkan hari saat ini
        switch ($hariIni) {
            case 'Monday':
                $piketHariIni = JadwalPiket::where('hari', 'Senin')->get();
                break;
            case 'Tuesday':
                $piketHariIni = JadwalPiket::where('hari', 'Selasa')->get();
                break;
            case 'Wednesday':
                $piketHariIni = JadwalPiket::where('hari', 'Rabu')->get();
                break;
            case 'Thursday':
                $piketHariIni = JadwalPiket::where('hari', 'Kamis')->get();
                break;
            case 'Friday':
                $piketHariIni = JadwalPiket::where('hari', 'Jumat')->get();
                break;
            default:
                // Default jika tidak ditemukan jadwal untuk hari ini
                $piketHariIni = [];
                break;
            }
        // Ambil user yang sedang login
        $user = auth()->user();
        // ambil user dengan urutan skor
        $users = User::orderBy('skor', 'desc')->take(3)->get();

        // Ambil tugas yang dimiliki oleh user tersebut
        $tugasItems = $user->tugas;

        return view('user.dashboard', compact('user', 'tugasItems', 'users', 'hariIni', 'piketHariIni'));
    }
    public function tasklist()
    {
        $tugas = Tugas::all();

        return view('user.tasklist', compact('tugas'));
    }
    public function ubah($tugasId)
    {
        $tugas = Tugas::find($tugasId);
        $users = User::all();
        $admins = User::where('role', 'admin')->get();

        if (!$tugas) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan.');
        }

        return view('user.ubah', compact('tugas', 'users', 'admins'));
    }
    public function ubahdata(Request $request, $tugasId)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'user_id' => 'required',
            'admin_id' => 'required',
        ]);

        $simpan = Tugas::find($tugasId);
        $simpan->judul = $request->judul;
        $simpan->deskripsi = $request->deskripsi;
        $simpan->user_id = $request->user_id;
        $simpan->admin_id = $request->admin_id;
        $simpan->save();
        return redirect()->route('user.dashboard')->with('success', 'Tugas berhasil diupdate!');
    }
    public function leaderboard()
    {
        $users = User::orderBy('skor', 'desc')->get();
        return view('user.leaderboard', compact('users'));
    }
    public function edit(Request $request, $tugasId)
    {

    }
}
