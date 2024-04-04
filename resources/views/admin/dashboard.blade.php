@extends('layouts.bar')

@section('title') Dashboard @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> @endsection

@section('content')
        <div class="task-list">
            <div class="task-content">
                <div class="task-container">
                    <h1 class="judul-task">Task list saya</h1>
                    <table class="task-table" width="100%">
                        <tr class="head">
                            <td class="head">Tugas</td>
                            <td class="head">Nama</td>
                            <td class="head">Status</td>
                            <td class="head" width="150px">Tanggal<br> Mulai</td>
                            <td class="head" width="150px">Tanggal<br> Berakhir</td>
                            <td class="head" width="50px">Aksi</td>
                            <td class="head" width="50px">Aksi</td>
                        </tr>
                        @foreach($tugas as $tugasItem)
                        <tr>
                            <td>{{ $tugasItem->judul }}</td>
                            <td><img src="{{ asset('storage/' . $tugasItem->user->foto) }}" id="profil-picture" width="25px" height="25px" class="foto" align="center">{{ $tugasItem->user->name }}</td>
                            <td class="button-container">
                                @if ($tugasItem->user_id == auth()->user()->id)
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
                                @else
                                    @if ($tugasItem->status == 'Belum Di Kerjakan')
                                    <div class="btn-on-1"><i class="fa-solid fa-clock"></i>Belum dikerjain</div>
                                    @endif
                                    @if ($tugasItem->status == 'Lagik Di Kerjakan')
                                        <div class="btn-on-2"><i class="fa-solid fa-clock"></i>sabar lagi dikerjain</div>
                                    @endif
                                    @if ($tugasItem->status == 'Udahdah')
                                    <div class="btn-on-3"><i class="fa-solid fa-clock"></i>Sudah selesai</div>
                                    @endif
                                @endif

                            </td>
                            <td>{{ \Carbon\Carbon::parse($tugasItem->mulai)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($tugasItem->selesai)->format('d-m-Y') }}</td>
                            <td><a href="{{ route('tugas.detail', ['tugasId' => $tugasItem->id]) }}" class="pen"><i class="fa-solid fa-pen"></i></a></td>
                            <td><a href="{{ route('hapus', ['id' => $tugasItem->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a></td>
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
                            <td class="no" >{{ $index + 1 }}. <img src="{{ $index === 0 ? asset('img/jl1.png') : ($index === 1 ? asset('img/jl2.png') : ($index === 2 ? asset('img/jl3.png') : '')) }}" alt="Medal" width="25px" height="25px" class="medal"></td>
                            <td>{{  $user->name }}</td>
                            <td align="right"><a href="{{ route('admin.score', $user) }}" class="pen"><i class="fa-solid fa-pen"></i></a> {{ $user->skor }} <img src="img/star.png" alt="" width="25px" align="center" class="star"> </td>
                        </tr>
                        @endforeach
                    </table>
                    <a href="@if (auth()->user()->role === 'admin') {{ route('admin.leaderboard') }} @else {{ route('user.leaderboard') }} @endif" class="more"><p align="center">selengkapnya</p></a>
                </div>
            </div>
        </div>
               <div class="tambah">
            <div class="tambah-content">
                <div class="container-tambah">
                    <h3 class="t">Yang mulia tolong berikan tugas</h3>
                    <a href="{{ 'tambah' }}"><img src="img/plus.png" alt="" width="100px"></a>
                </div>
            </div>
        </div>
    </div>
    @endsection

