@extends('layouts.bar')

@section('title') Tambah Tugas @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/tambah.css') }}">

@section('content')
<div class="form-tambah">
    <form method="POST" action="{{ route('simpan') }}">
        @csrf
        <div class="form-content-1">
            <h2 class="tambah-judul">Tambah tugas</h2>
            <a href="@if (auth()->user()->role === 'admin') {{ route('admin.dashboard') }} @else {{ route('user.dashboard') }} @endif" class="back"><img src="{{ asset('img/xmark.png') }}" alt="" width="50px" height="50px"></a>
        </div>
        <div class="form">
            <div class="form-container">
                <div class="form-content-2">
                        <label for="judul">Judul</label>
                            <div class="input-box">
                                <input type="text" name="judul" @error('judul') is-invalid @enderror" id="judul" value="{{ old('judul') }}" required autocomplete="judul" autofocus>
                                @error('judul')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        <label for="user_id">Nama</label>
                            <div class="input-select-box">
                                <select name="user_id" @error('user_id') is-invalid @enderror" id="user_id" value="{{ old('user_id') }}" required autocomplete="user_id">
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
                        <label for="admin_id">Nama pemberi tugas</label>
                            <div class="input-select-box">
                                <select name="admin_id" @error('admin_id') is-invalid @enderror" id="admin_id" value="{{ old('admin_id') }}" required autocomplete="admin_id">
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
                        <label for="skor">Skor</label>
                            <div class="input-box">
                                <input type="number" name="skor" @error('skor') is-invalid @enderror" max="255" id="skor" value="{{ old('skor') }}" required autocomplete="skor">
                                @error('skor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        <label for="pengurangan_skor">Pengurangan  skor</label>
                            <div class="input-box">
                                <input type="number" name="pengurangan_skor" @error('pengurangan_skor') max="255" is-invalid @enderror" id="pengurangan_skor" value="{{ old('pengurangan_skor') }}" required autocomplete="pengurangan_skor">
                                @error('pengurangan_skor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        <label for="selesai">Waktu berakhir tugas</label>
                            <div class="input-box">
                                <input type="date" name="selesai" @error('selesai') is-invalid @enderror" id="selesai" value="{{ old('selesai') }}" required autocomplete="selesai">
                                @error('selesai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        <label for="deskripsi">Deskripsi Tugas</label>
                            <div class="input-box">
                                <textarea name="deskripsi" cols="30" rows="10" @error('deskripsi') is-invalid @enderror" id="deskripsi" value="{{ old('deskripsi') }}" required autocomplete="deskripsi"></textarea>
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
