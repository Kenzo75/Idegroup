@extends('layouts.bar')

@section('title') Ubah Tugas @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/tambah.css') }}">

@section('content')
<div class="form-tambah">
    <form method="POST" action="{{ route('user.ubahdata', ['tugasId' => $tugas->id]) }}">
        @csrf
        <div class="form-content-1">
            <h2 class="tambah-judul">Ubah Tugas</h2>
            <a href="@if (auth()->user()->role === 'admin') {{ route('admin.dashboard') }} @else {{ route('user.dashboard') }} @endif" class="back"><img src="{{ asset('img/xmark.png') }}" alt="" width="50px" height="50px"></a>
        </div>
        <div class="form">
            <div class="form-container">
                <div class="form-content-2">
                        <label for="judul">Judul</label>
                            <div class="input-box">
                                <input type="text" name="judul" id="judul" @error('judul') is-invalid @enderror" value="{{ old('judul', $tugas->judul) }}" required autocomplete="judul" autofocus>
                                @error('judul')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        <label for="user_id">Nama</label>
                            <div class="input-select-box">
                                <select name="user_id" @error('user_id') id="user_id" is-invalid @enderror" value="{{ old('user_id', $tugas->user_id) }}" required autocomplete="user_id">
                                    <!-- Nilai awal dipilih sesuai dengan nama pengguna yang saat ini masuk -->
                                    <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                                    <!-- Opsi untuk pengguna lain -->
                                    @foreach($users as $user)
                                        <!-- Jika pengguna bukan pengguna saat ini, tambahkan sebagai opsi -->
                                        @if($user->id !== auth()->user()->id)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        <label for="admin_id">Nama Pemberi Tugas</label>
                            <div class="input-select-box">
                                <select name="admin_id" @error('admin_id') id="admin_id" is-invalid @enderror" value="{{ old('admin_id', $tugas->admin_id) }}" required autocomplete="admin_id">
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                                @error('admin_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        <label for="deskripsi">Deskripsi Tugas</label>
                            <div class="input-box">
                                <textarea name="deskripsi" cols="30" rows="10" id="deskripsi" @error('deskripsi') is-invalid @enderror" value="{{ old('deskripsi') }}" required autocomplete="deskripsi">{{ $tugas->deskripsi }}</textarea>
                                @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                    <input type="submit" value="Submit" class="submit">
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

