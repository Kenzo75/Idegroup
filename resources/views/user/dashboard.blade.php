@extends('layouts.bar')

@section('title') Dashboard @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> @endsection

@section('content')
        <div class="task-list">
            <div class="task-content">
                <div class="task-container">
                    <h1>Task list saya</h1>
                    <table class="task-table" width="100%">
                        <tr class="head">
                            <td class="head">Tugas</td>
                            <td class="head">Status</td>
                            <td class="head">Tanggal<br> Mulai</td>
                            <td class="head">Tanggal<br> Berakhir</td>
                            <td class="head">Aksi</td>
                        </tr>
                        <tr>
                            @foreach($tugasItems as $tugasItem)
                            <td>{{ $tugasItem->judul }}</td>
                            <td class="button-container">
                                @if ($tugasItem->status == 'Udahdah')
                                    <div class="btn-on-3">Tugas anda telah selesai</div>
                                    @else
                                        @if ($tugasItem->status == 'Belum Di Kerjakan')
                                        <a href="{{ route('ubahstatus', ['idtugas' => $tugasItem->id, 'status' => 'Belum Di Kerjakan']) }}" class="btn-on-1"><i class="fa-solid fa-clock"></i>Belum Di Kerjakan</a> -
                                        @else
                                        <a href="{{ route('ubahstatus', ['idtugas' => $tugasItem->id, 'status' => 'Belum Di Kerjakan']) }}" class="btn-off-1">Belum Di Kerjakan</a> -
                                        @endif

                                        @if ($tugasItem->status == 'Lagik Di Kerjakan')
                                        <a href="{{ route('ubahstatus', ['idtugas' => $tugasItem->id, 'status' => 'Lagik Di Kerjakan']) }}" class="btn-on-2"><i class="fa-solid fa-clock"></i>Lagik Di Kerjakan</a>
                                        @else
                                        <a href="{{ route('ubahstatus', ['idtugas' => $tugasItem->id, 'status' => 'Lagik Di Kerjakan']) }}" class="btn-off-2">Lagik Di Kerjakan</a>
                                        @endif
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($tugasItem->mulai)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($tugasItem->selesai)->format('d-m-Y') }}</td>
                            <td>
                                @if ($tugasItem->status === 'Udahdah')
                                <a href="{{ route('hasil.hasil', ['tugasId' => $tugasItem->id]) }}" class="pen"><i class="fa-solid fa-pen"></i></a>
                                @else
                                    <a href="{{ route('tugas.detail', ['tugasId' => $tugasItem->id]) }}" class="pen"><i class="fa-solid fa-pen"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="leaderboard">
            <div class="lead-content">
                <div class="container-lead">
                    <h2 class="l">Leaderboard</h2>
                    <table class="lead-table" width="100%">
                        @foreach($users as $index => $user)
                        <tr>
                            <td class="no">{{ $index + 1 }}.<img src="{{ $index === 0 ? asset('img/jl1.png') : ($index === 1 ? asset('img/jl2.png') : ($index === 2 ? asset('img/jl3.png') : '')) }}" alt="Medal" width="25px" height="25px" class="medal"></td>
                            <td>{{  $user->name }}</td>
                            <td align="right">{{ $user->skor }} <img src="img/star.png" alt="" width="25px" align="center" class="star"> </td>
                        </tr>
                        @endforeach
                    </table>
                    <a href="@if (auth()->user()->role === 'admin') {{ route('admin.leaderboard') }} @else {{ route('user.leaderboard') }} @endif" class="more"><p>selengkapnya</p></a>
                </div>
            </div>
        </div>

        <div class="jadwal">
            <div class="jadwal-content">
                <div class="container-jadwal">
                    <h2 class="hari">{{ $hariIni }}</h2>
                    <table width="80%" align="center">
                        @if ($piketHariIni->count() > 0)
                            @foreach($piketHariIni as $key => $piket)
                            <tr>
                                <td>{{ $key + 1 }}. {{ $piket->user->name }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Tidak ada petugas piket untuk hari ini.</td>
                            </tr>
                        @endif

                    </table>
                    <a href="{{ route('jadwal') }}" class="more"><p>selengkapnya</p></a>
                </div>
            </div>
        </div>
    </div>
@endsection
