@extends('layouts.bar')

@section('title')
    Edit Jadwal Petugas
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
                    <h2>Edit petugas piket</h2>
                </div>
                <div class="button">
                    <a class="back" href="{{ route('jadwal') }}" class="back"><img src="{{ asset('img/xmark.png') }}" width="40px" height="40px"><br>BACK</a>
                </div>
            </div>
            <hr width="100%">
            <div class="body">
                <form method="POST" action="{{ route('jadwal.update', ['id' => $jadwal->id]) }}">
                    @csrf
                    <div class="input-group">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari" @error('hari') is-invalid @enderror" value="{{ old('hari', $jadwal->hari) }}" required autocomplete="hari">
                            <option value="Senin" {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="user_id">Nama Petugas</label>
                        <select name="user_id" id="user_id" @error('user_id') is-invalid @enderror" value="{{ old('user_id', $jadwal->user_id) }}" required autocomplete="user_id">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $jadwal->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
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

