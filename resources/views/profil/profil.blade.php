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
                            Yang Mulia Mentor
                            @else
                            Anak Magang
                            @endif
                        </h5>
                        @if (auth()->user()->role === 'admin')
                            <p class="admin">Anda Mentor</p>
                        @else
                        <p class="@if ($user->team == 'Administrator') bidang-1 @elseif ($user->team == 'Programmer') bidang-2 @else bidang-3 @endif">{{ $user->team }}</p>
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
                    <p class="isi-body">Asal Sekolah : {{ $user->sekolah }}</p>
                    <p class="isi-body">Jenis Kelamin : {{ $user->gender }}</p>
                    <P class="isi-body">Status : {{ $user->status }}</P>
                    <div class="kata-mutiara">
                        <p class="mutiara">Kata-Kata Mutiara : </p>
                        <p>{{ $user->kata_mutiara }}</p>
                    </div>
                    <a href="{{ route('profil.edit') }}" class="edit-profil">Edit profil</a>
                </div>
            </div>
        </div>
    </div>
@endsection
