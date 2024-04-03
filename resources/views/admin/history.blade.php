@extends('layouts.bar')

@section('title') History Tugas @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/history.css') }}"> @endsection

@section('content')
<div class="task-list">
    <div class="task-content">
        <div class="container">
            <h2>History Tugas</h2>
            <table class="task-table" width="100%">
                <tr class="history">
                    <td colspan="2" class="head">Tugas</td>
                    <td class="head">Nama</td>
                    <td class="head">status</td>
                    <td class="head">Tanggal<br> Mulai</td>
                    <td class="head">Tanggal<br> Berakhir</td>
                    <td class="head"></td>
                </tr>
                @foreach ($tugasSelesai as $tugas )
                <tr>
                    <td colspan="2">{{ $tugas->judul }}</td>
                    <td><img src="{{ asset('storage/' . $tugas->user->foto) }}" id="profil-picture" width="25px" height="25px" class="foto" align="center">{{ $tugas->user->name }}</td>
                    <td>@if ($tugas->status == 'Udahdah')
                            <div class="btn-on-3">Tugas nya sudah selesai</div>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($tugas->mulai)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($tugas->selesai)->format('d-m-Y') }}</td>
                    <td><a href="{{ route('hasil.hasil', ['tugasId' => $tugas->id]) }}">Selengkapnya</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
