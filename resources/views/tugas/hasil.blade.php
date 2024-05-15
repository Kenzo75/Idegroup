@extends('layouts.bar')

@section('title')
    Kirim Tugas
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
                Tugas :
                <h3 class="judul-text">{{ $tugas->judul }}</h3>
                (skor yang di dapat : {{ $tugas->skor }})
                @if ( $keterlambatan > 0 )
                    anda terlambat {{ $keterlambatan }} hari
                @else
                @endif
                </div>
                <div class="button">
                    <a class="back" href="@if (auth()->user()->role === 'admin') {{ route('admin.dashboard') }} @else {{ route('user.dashboard') }} @endif" class="back"><img src="{{ asset('img/xmark.png') }}" width="40px" height="40px"><br>BACK</a>
                </div>
            </div>
            <hr width="100%">
            <div class="body">
                <form method="POST" action="{{ route('hasil-tugas.store', ['tugasId' => $tugas->id]) }}">
                    @csrf
                    <div class="input-group">
                        <label for="">Link Hasil Tugas</label>
                        <input type="url" name="link_hasil" id="link_hasil" placeholder="Masukan link figma/github hasil tugas (jika ada)">
                    </div>
                    <div class="input-group">
                        <label for="">Keterangan</label>
                        <textarea name="deskripsi" id="" cols="30" rows="10" id="deskripsi" placeholder="Masukan deksripsi/penjelasan dari hasil tugas yang di berikan" name="deskripsi" rows="3" @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" required autocomplete="deskripsi"></textarea>
                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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

