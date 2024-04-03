<?php

namespace App\Http\Controllers;

use App\Models\tugas;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JadwalPiket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\User as Authenticatable;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tugas = Tugas::all();
        $users = User::orderBy('skor', 'desc')->take(3)->get();
        return view('admin.dashboard', compact('tugas', 'users'));
    }

    public function tambah()
    {
        $users = User::all();
        $admins = User::where('role', 'admin')->get();
        return view('tugas.tambah', compact('users', 'admins'));
    }

    public function simpan(Request $request)
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

        $simpan = new tugas();
        $simpan->judul = $request->judul;
        $simpan->deskripsi = $request->deskripsi;
        $simpan->selesai = $request->selesai;
        $simpan->skor = $request->skor;
        $simpan->pengurangan_skor = $request->pengurangan_skor;
        $simpan->user_id = $request->user_id;
        $simpan->admin_id = $request->admin_id;
        $simpan->save();
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Tugas berhasil ditambahkan!');
        } else {
            return redirect()->route('user.dashboard')->with('success', 'Tugas berhasil ditambahkan!');
        }
    }

    public function ubahstatus($idtugas, $status)
    {
        $ubahdata = tugas::find($idtugas);
        $ubahdata->status = $status;
        $ubahdata->save();
        return redirect()->back();
    }
}
