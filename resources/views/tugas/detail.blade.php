@extends('layouts.bar')

@section('title') Detail Tugas @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/cek.css') }}">@endsection

@section('content')
<div class="detail">
    <div class="detail-content-1">
        <a href="@if (auth()->user()->role === 'admin') {{ route('admin.dashboard') }} @else {{ route('user.dashboard') }} @endif" class="back"><img src="{{ asset('img/xmark.png') }}" width="40px" height="40px"><br>BACK</a>
    </div>
        <div class="detail-container">
            <div class="detail-content-2">
                <h3 class="detail-tugas">Cek Tugas</h3>
                    <table>
                        <tr>
                            <td>Judul :</td>
                            <td>{{ $tugas->judul }}</td>
                        </tr>
                        <tr>
                            <td>Nama :</td>
                            <td>{{ $tugas->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Bidang :</td>
                            <td>{{ $tugas->user->team }}</td>
                        </tr>
                        <tr>
                            <td>Skor :</td>
                            <td>{{ $tugas->skor }}</td>
                        </tr>
                        <tr>
                            <td>Status :</td>
                            <td>{{ $tugas->status }}</td></td>
                        </tr>
                        <tr>
                            <td>Pemberi tugas :</td>
                            <td>{{ $tugas->admin->name }}</td>
                        </tr>
                        <tr>
                            <td>Waktu pengerjaan :</td>
                            <td>{{ $tugas->mulai }} <i class="fa-solid fa-grip-lines"></i><i class="fa-solid fa-angles-right"></i> {{ $tugas->selesai }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Deskripsi :</td>
                        </tr>
                        <tr>
                            <td colspan="2">{{ $tugas->deskripsi }}</td>
                        </tr>
                    </table>
                        @if ($tugas->user_id === auth()->user()->id)

                        <div class="btn-container">
                            <div class="btn-aksi">
                                <a href="@if (auth()->user()->role === 'admin') {{ route('admin.ubah', ['tugasId' => $tugas->id]) }} @else {{ route('user.ubah', ['tugasId' => $tugas->id]) }} @endif" class="ubah">UBAH</a>
                                <a href="{{ route('tugas.selesai', ['tugasId' => $tugas->id]) }}" class="selesai">SELESAI</a>
                            </div>
                        </div>
                        @elseif (auth()->user()->role === 'admin')
                            <div class="btn-container">
                                <div class="btn-aksi">
                                    <a href="@if (auth()->user()->role === 'admin') {{ route('admin.ubah', ['tugasId' => $tugas->id]) }} @else {{ route('user.ubah', ['tugasId' => $tugas->id]) }} @endif" class="ubah">UBAH</a>
                                </div>
                            </div>
                        @else
                        @endif


            </div>
        </div>
</div>
@endsection
