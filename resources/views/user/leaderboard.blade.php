@extends('layouts.bar')

@section('title') Leaderboard @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}"> @endsection

@section('content')
<div class="leaderboard">
    <div class="lead-container">
        <div class="lead-content">
            <div class="judul">
                <h2>Leaderboard</h2>
                <hr width="100%">
            </div>
            <div class="lead-tabel">
                <table width="90%" align="center">
                    @foreach($users as $index => $user)
                    <tr>
                        <td style="position: relative;">
                            {{ $index + 1 }}.
                            <img src="{{ asset('storage/' . $user->foto) }}" id="profil-picture" width="30px" height="30px" class="foto">
                            @if ($index === 0)
                                <img src="{{ asset('img/jl1.png') }}" alt="Gold Medal" width="25px" height="25px" class="medal">
                            @elseif ($index === 1)
                                <img src="{{ asset('img/jl2.png') }}" alt="Silver Medal" width="25px" height="25px" class="medal">
                            @elseif ($index === 2)
                                <img src="{{ asset('img/jl3.png') }}" alt="Bronze Medal" width="25px" height="25px" class="medal">
                            @else

                            @endif
                            {{ $user->name }}
                        </td>
                        <td align="right"><b>{{ $user->skor }}</b> <img src="img/star.png" alt="" width="25px" align="center" class="star"></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
