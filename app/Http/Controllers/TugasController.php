<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tugas;
use App\Models\HasilTugas;
use Carbon\Carbon;
use App\Models\User;



class TugasController extends Controller
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
    public function showForm($tugasId)
    {
        $tugas = Tugas::findOrFail($tugasId); // Ambil informasi tugas berdasarkan ID

        $keterlambatan = 0;
        if ($tugas->selesai < now()) {
            $keterlambatan = Carbon::parse($tugas->selesai)->diffInDays(now());
        }

        return view('tugas.hasil', compact('tugas', 'keterlambatan'));
    }

    public function storeHasilTugas(Request $request, $tugasId)
    {
    // Validasi data
    $request->validate([
        'deskripsi' => 'required',
    ]);

    // Simpan hasil tugas ke dalam database
    $hasilTugas = new HasilTugas();
    $hasilTugas->tugas_id = $tugasId;
    $hasilTugas->link_hasil = $request->link_hasil;
    $hasilTugas->deskripsi = $request->deskripsi;
    $hasilTugas->save();

    // Mengubah status tugas menjadi "udahdah"
    $tugas = Tugas::findOrFail($tugasId);
    $tugas->status = 'Udahdah';
    $tugas->save();

    // Periksa apakah hasil tugas dikirimkan setelah batas waktu (selesai)
    if ($tugas->selesai < now()) {
        // Hitung selisih hari terlambat
        $selisihHari = Carbon::parse($tugas->selesai)->diffInDays(now());

        // Hitung pengurangan skor
        $penguranganSkor = $selisihHari * $tugas->pengurangan_skor;

        // Kurangi skor dari tugas
        $skorTugas = $tugas->skor - $penguranganSkor;

        // Update skor tugas
        $tugas->skor = $skorTugas;
        $tugas->save();

        // Kurangi atau tambahkan skor pengguna tergantung pada hasil skor tugas yang sudah dikurangi pengurangan skor
        $user = auth()->user();
        if ($skorTugas >= 0) {
            // Jika skor tugas positif, tambahkan ke skor pengguna
            $user->skor += $skorTugas;
        } else {
            // Jika skor tugas negatif, kurangi skor pengguna dengan nilai absolut dari skor tugas
            $user->skor -= abs($skorTugas);
        }
        $user->save();
        } else {
            // Tugas dikumpulkan tepat waktu, tambahkan skor tugas ke skor pengguna
            $user = auth()->user();
            $user->skor += $tugas->skor;
            $user->save();
        }

    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard')->with('success', 'Tugas berhasil ditambahkan!');
    } else {
        return redirect()->route('user.dashboard')->with('success', 'Tugas berhasil ditambahkan!');
    }
    }

    public function show($tugasId)
    {
        $tugas = Tugas::find($tugasId);

        if (!$tugas) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan.');
        }

        return view('tugas.detail', compact('tugas'));
    }
    public function hasil($tugasId)
    {
        // Ambil tugas berserta hasilnya
        $tugas = Tugas::with('hasilTugas')->find($tugasId);

        // Jika tugas ditemukan
        if ($tugas) {
            // Kemudian Anda bisa mengirimkan data tugas ke view
            return view('hasil.hasil', compact('tugas'));
        } else {
            // Tugas tidak ditemukan, kembali ke halaman sebelumnya atau tampilkan pesan kesalahan
            return back()->with('error', 'Tugas tidak ditemukan.');
        }
    }
    public function edithasil($tugasId)
    {
        // Ambil tugas berserta hasilnya
        $tugas = Tugas::with('hasilTugas')->find($tugasId);
        // Jika tugas ditemukan
        if ($tugas) {
            // Kemudian Anda bisa mengirimkan data tugas ke view
            return view('hasil.edit-hasil', compact('tugas'));
        } else {
            // Tugas tidak ditemukan, kembali ke halaman sebelumnya atau tampilkan pesan kesalahan
            return back()->with('error', 'Tugas tidak ditemukan.');
        }
    }
    public function kirimHasil(Request $request, $tugasId)
    {
        // Ambil tugas berserta hasilnya
        $tugas = Tugas::with('hasilTugas')->find($tugasId);

        // Periksa apakah tugas ditemukan
        if (!$tugas) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan');
        }

        // Simpan link hasil tugas dan deskripsi ke dalam model HasilTugas
        $hasilTugas = $tugas->hasilTugas;
        $hasilTugas->link_hasil = $request->link_hasil;
        $hasilTugas->deskripsi = $request->deskripsi;
        $hasilTugas->save();

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.history')->with('success', 'Hasil tugas berhasil diedit!');
        } else {
            return redirect()->route('user.dashboard')->with('success', 'Hasil tugas berhasil diedit!');
        }

    }
}
