@extends('layouts.bar')

@section('title')
    Edit Skor User
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/kirim.css') }}">
@endsection

@section('content')
<div class="hasil">
    <div class="kirim-container">
        <div class="kirim-content">
            <div class="head">
                <div class="judul">
                user :
                <h3 class="judul-text">{{ $user->name }}</h3>
                </div>
                <div class="button">
                    <a class="back" href="@if (auth()->user()->role === 'admin') {{ route('admin.dashboard') }} @else {{ route('user.dashboard') }} @endif" class="back"><img src="{{ asset('img/xmark.png') }}" width="40px" height="40px"><br>BACK</a>
                </div>
            </div>
            <hr width="100%">
            <div class="body">
                <form method="POST" action="{{ route('admin.update-score', $user) }}">
                    @csrf
                    <div class="input-group">
                        <label for="skor">Ganti Skor</label>
                        <input type="number" name="skor" id="skor" placeholder="Ubah skor anak magang" value="{{ old('skor', $user->skor) }}">
                    </div>
                    <div class="input-group">
                        <input type="submit" value="Kirim" class="submit">
                    </div>
                </form>
            </div>

                    {{-- <form method="POST" action="{{ route('hasil-tugas.store', ['tugasId' => $tugas->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="link_hasil">Link Hasil Tugas:</label>
                            <input type="url" class="form-control" id="link_hasil" name="link_hasil">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi:</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" required autocomplete="deskripsi"></textarea>
                            @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" value="kirim" class="btn btn-primary mt-2">
                        </div>
                    </form> --}}
        </div>
    </div>
</div>
@endsection

