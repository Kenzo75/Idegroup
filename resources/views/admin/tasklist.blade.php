@extends('layouts.bar')

@section('title')TaskList @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/task.css') }}">@endsection

@section('content')
        <div class="task-list">
            <div class="task-content">
                <div class="task-container">
                    <h1 class="judul-task">Daftar Semua Tugas Anak Magang</h1>
                    <table class="task-table" width="100%">
                        <tr class="head">
                            <td class="head">Tugas</td>
                            <td class="head">Nama</td>
                            <td colspan="2" class="head">Status</td>
                            <td class="head">Tanggal<br> Mulai</td>
                            <td class="head">Tanggal<br> Berakhir</td>
                            <td class="head">Aksi</td>
                            <td class="head">Aksi</td>
                        </tr>
                        @foreach($tugas as $tugasItem)
                        <tr>
                            <td>{{ $tugasItem->judul }}</td>
                            <td><img src="{{ asset('storage/' . $tugasItem->user->foto) }}" id="profil-picture" width="25px" height="25px" class="foto" align="center">{{ $tugasItem->user->name }}</td>
                            <td colspan="2">
                                @if ($tugasItem->status == 'Belum Di Kerjakan')
                                <div class="btn-on-1"><i class="fa-solid fa-clock"></i>Belum dikerjain</div>
                                @endif
                                @if ($tugasItem->status == 'Lagik Di Kerjakan')
                                    <div class="btn-on-2"><i class="fa-solid fa-clock"></i>sabar lagi dikerjain</div>
                                @endif
                                @if ($tugasItem->status == 'Udahdah')
                                <div class="btn-on-3"><i class="fa-solid fa-clock"></i>Sudah Selesai</div>
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
@endsection
