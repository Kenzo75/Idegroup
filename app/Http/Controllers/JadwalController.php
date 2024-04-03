<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPiket;
use App\Models\User;

class JadwalController extends Controller
{
    public function jadwal()
    {
    $pikets = JadwalPiket::all();
    $piketSenin = [];
    $piketSelasa = [];
    $piketRabu = [];
    $piketKamis = [];
    $piketJumat = [];

    foreach ($pikets as $piket) {
        switch ($piket->hari) {
            case 'Senin':
                $piketSenin[] = $piket;
                break;
            case 'Selasa':
                $piketSelasa[] = $piket;
                break;
            case 'Rabu':
                $piketRabu[] = $piket;
                break;
            case 'Kamis':
                $piketKamis[] = $piket;
                break;
            case 'Jumat':
                $piketJumat[] = $piket;
                break;
        }
    }

    return view('jadwal.jadwal', compact('pikets', 'piketSenin', 'piketSelasa', 'piketRabu', 'piketKamis', 'piketJumat'));
    }

    public function form()
    {
        $users = User::all();
        return view('jadwal.tambah', compact('users'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'user_id' => 'required',
        ]);

        $tambah = new JadwalPiket();
        $tambah->hari = $request->hari;
        $tambah->user_id = $request->user_id;
        $tambah->save();
        return redirect()->route('jadwal')->with('success', 'Berhasil menambah jadwal');
    }

    public function edit($id)
    {
        $users = User::all();
        $jadwal = JadwalPiket::findOrFail($id);
        return view('jadwal.edit_jadwal', compact('jadwal', 'users'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required',
            'user_id' => 'required',
        ]);

        $tambah = JadwalPiket::findOrFail($id);
        $tambah->hari = $request->hari;
        $tambah->user_id = $request->user_id;
        $tambah->save();
        return redirect()->route('jadwal')->with('success', 'Berhasil mengupdate jadwal');
    }

    public function hapus($id)
    {
        $jadwal = JadwalPiket::findOrFail($id)->delete();
        return redirect()->back();
    }
}
