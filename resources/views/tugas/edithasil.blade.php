@extends('layouts.bar')

@section('title') Hasil Tugas @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/cek.css') }}">@endsection

@section('content')
<div class="detail">
    <div class="detail-content-1">
        <a href="@if (auth()->user()->role === 'admin') {{ route('admin.history') }} @else {{ route('user.dashboard') }} @endif" class="back"><img src="{{ asset('img/xmark.png') }}" width="40px" height="40px"><br>BACK</a>
    </div>
        <div class="detail-container">
            <div class="detail-content-2">
                <h3 class="detail-tugas">Hasil Tugas</h3>
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
                            <td>Waktu Pengumpulan :</td>
                            <td>{{ $tugas->hasilTugas->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi pengerjaan :</td>
                            <td>{{ $tugas->hasilTugas->deskripsi }}</td>
                        </tr>
                        <tr>
                            <td>Url :</td>
                            <td>
                            @if($tugas->hasilTugas->link_hasil)
                                <a href="{{ $tugas->hasilTugas->link_hasil }}">{{ $tugas->hasilTugas->link_hasil }}</a>
                            @else
                                Tidak ada link hasil tugas untuk tugas ini.
                            @endif
                            </td>
                        </tr>
                    </table>
                        @if ($tugas->user_id === auth()->user()->id)

                        <div class="btn-container">
                            <div class="btn-aksi">
                                <a href="{{ route('tugas.hasiledit', ['tugasId' => $tugas->id]) }}" class="ubah">Edit Hasil</a>
                            </div>
                        </div>
                        @else
                        <div class="btn-container">
                            @if (auth()->user()->role === 'admin')
                                <div class="btn-aksi">
                                    <a href="{{ route('hapus', ['id' => $tugas->id]) }}" class="hapus">Hapus</a>
                                </div>
                            @else
                            @endif


                        @endif


            </div>
        </div>
</div>
@endsection
