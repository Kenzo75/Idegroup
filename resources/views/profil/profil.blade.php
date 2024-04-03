@extends('layouts.bar')

@section('title')
    Profil
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')
    <div class="profil">
        <div class="profil-container">
            <div class="profil-content">
                <div class="head">
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="" width="100px" height="100px" class="foto" id="profil-picture">
                    <div class="nama-text">
                        <b><h3>{{ $user->name }}</h3>
                        <h5>@if (auth()->user()->role === 'admin')
                            Yang mulia mentor
                            @else
                            Anak magang
                            @endif
                        </h5>
                        @if (auth()->user()->role === 'admin')
                            <p class="admin">Anda Mentor</p>
                        @else
                        <p class="@if ($user->team == 'Administrasi') bidang-1 @elseif ($user->team == 'Programmer') bidang-2 @else bidang-3 @endif">{{ $user->team }}</p>
                        @endif
                        </b>
                    </div>
                    <div class="sosmed">
                        <div class="ig"><i class="fa-brands fa-instagram"></i> {{ $user->instagram }}</div>
                        <div class="wa"><i class="fa-brands fa-whatsapp"></i> {{ substr($user->wa, 0, 4) . '-' . substr($user->wa, 4, 4) . '-' . substr($user->wa, 6) }}
                    </div>
                    </div>
                </div>
                <div class="body">
                    <p class="isi-body">{{ $user->email }}</p>
                    <p class="isi-body">Asal sekolah : {{ $user->sekolah }}</p>
                    <p class="isi-body">Jenis kelamin : {{ $user->gender }}</p>
                    <P class="isi-body">status : {{ $user->status }}</P>
                    <div class="kata-mutiara">
                        <p class="mutiara">Kata-kata mutiara : </p>
                        <p>{{ $user->kata_mutiara }}</p>
                    </div>
                    <a href="{{ route('profil.edit') }}" class="edit-profil">Edit profil</a>
                </div>
            </div>
        </div>
    </div>
@endsection
