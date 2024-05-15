@extends('layouts.bar')

@section('title') Jadwal Piket @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/jadwal.css') }}">@endsection

@section('content')
    <div class="jadwal">
        <div class="jadwal-content">
            <div class="judul">
                <div class="text">
                    <h2>Jadwal Piket</h2>
                </div>
            </div>
            <hr>
            <div class="tombol"><a href="{{ route('form.jadwal') }}" class="btn-tambah">Tambah</a></div>
            <div class="tabel-jadwal">

                <div class="box">
                    <table>
                        <tr>
                            <td align="center" class="colum"><div class="head">SENIN</div></td>
                        </tr>
                        <tr>
                            <td align="center">
                                @foreach($piketSenin as $key => $piket)
                                <div class="nama-user">{{ $key + 1 }}. {{ $piket->user->name }} <a href="{{ route('jadwal.edit', $piket->id) }}" class="pen"><i class="fa-solid fa-pen"></i></a> <a href="{{ route('hapus.jadwal', ['id' => $piket->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a> <br> </div>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="box">
                    <table>
                        <tr>
                            <td align="center" class="colum"><div class="head">SELASA</div></td>
                        </tr>
                        <tr>
                            <td align="center">
                                @foreach($piketSelasa as $key => $piket)
                                <div class="nama-user">{{ $key + 1 }}. {{ $piket->user->name }} <a href="{{ route('jadwal.edit', $piket->id) }}" class="pen"><i class="fa-solid fa-pen"></i></a> <a href="{{ route('hapus.jadwal', ['id' => $piket->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a> <br> </div>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="box">
                    <table>
                        <tr>
                            <td align="center" class="colum"><div class="head">RABU</div></td>
                        </tr>
                        <tr>
                            <td align="center">
                                @foreach($piketRabu as $key => $piket)
                                <div class="nama-user">{{ $key + 1 }}. {{ $piket->user->name }} <a href="{{ route('jadwal.edit', $piket->id) }}" class="pen"><i class="fa-solid fa-pen"></i></a> <a href="{{ route('hapus.jadwal', ['id' => $piket->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a> <br> </div>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="box">
                    <table>
                        <tr>
                            <td align="center" class="colum"><div class="head">KAMIS</div></td>
                        </tr>
                        <tr>
                            <td align="center">
                                @foreach($piketKamis as $key => $piket)
                                <div class="nama-user">{{ $key + 1 }}. {{ $piket->user->name }} <a href="{{ route('jadwal.edit', $piket->id) }}" class="pen"><i class="fa-solid fa-pen"></i></a> <a href="{{ route('hapus.jadwal', ['id' => $piket->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a> <br> </div>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="box">
                    <table>
                        <tr>
                            <td align="center" class="colum"><div class="head">JUM'AT</div></td>
                        </tr>
                        <tr>
                            <td align="center">
                                @foreach($piketJumat as $key => $piket)
                                <div class="nama-user">{{ $key + 1 }}. {{ $piket->user->name }} <a href="{{ route('jadwal.edit', $piket->id) }}" class="pen"><i class="fa-solid fa-pen"></i></a> <a href="{{ route('hapus.jadwal', ['id' => $piket->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a> <br> </div>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                {{-- <table width="100%">
                                <tr>
                                    <td align="center" class="colum"><div class="head">SENIN</div></td>
                                    <td align="center" class="colum"><div class="head">SELASA</div></td>
                                    <td align="center" class="colum"><div class="head">RABU</div></td>
                                    <td align="center" class="colum"><div class="head">KAMIS</div></td>
                                    <td align="center" class="colum"><div class="head">JUM'AT</div></td>
                                </tr>
                                    <tr>
                                        <td align="center">
                                            @foreach($piketSenin as $key => $piket)
                                            <div class="nama-user">{{ $key + 1 }}. {{ $piket->user->name }} <a href="{{ route('jadwal.edit', $piket->id) }}" class="pen"><i class="fa-solid fa-pen"></i></a> <a href="{{ route('hapus.jadwal', ['id' => $piket->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a> <br> </div>
                                            @endforeach
                                        </td>
                                        <td align="center">
                                            @foreach($piketSelasa as $key => $piket)
                                            <div class="nama-user">{{ $key + 1 }}. {{ $piket->user->name }} <a href="{{ route('jadwal.edit', $piket->id) }}" class="pen"><i class="fa-solid fa-pen"></i></a> <a href="{{ route('hapus.jadwal', ['id' => $piket->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a> <br> </div>
                                            @endforeach
                                        </td>
                                        <td align="center">
                                            @foreach($piketRabu as $key => $piket)
                                            <div class="nama-user">{{ $key + 1 }}. {{ $piket->user->name }} <a href="{{ route('jadwal.edit', $piket->id) }}" class="pen"><i class="fa-solid fa-pen"></i></a> <a href="{{ route('hapus.jadwal', ['id' => $piket->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a> <br> </div>
                                            @endforeach
                                        </td>
                                        <td align="center">
                                            @foreach($piketKamis as $key => $piket)
                                            <div class="nama-user">{{ $key + 1 }}. {{ $piket->user->name }} <a href="{{ route('jadwal.edit', $piket->id) }}" class="pen"><i class="fa-solid fa-pen"></i></a> <a href="{{ route('hapus.jadwal', ['id' => $piket->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a> <br> </div>
                                            @endforeach
                                        </td>
                                        <td align="center">
                                            @foreach($piketJumat as $key => $piket)
                                            <div class="nama-user">{{ $key + 1 }}. {{ $piket->user->name }} <a href="{{ route('jadwal.edit', $piket->id) }}" class="pen"><i class="fa-solid fa-pen"></i></a> <a href="{{ route('hapus.jadwal', ['id' => $piket->id]) }}" class="trash"><i class="fa-solid fa-trash"></i></a> <br> </div>
                                            @endforeach
                                        </td>
                                    </tr>
                            </table> --}}
            </div>

        </div>
    </div>
@endsection
