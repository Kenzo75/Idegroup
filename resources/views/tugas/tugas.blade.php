@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-15">
            <div class="card" style="overflow-x: auto; max-width: 10000;">
                <div class="card-header">{{ __('Daftar Tugas') }}</div>

                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th width="150">Judul</th>
                                <th width="150">Deskripsi</th>
                                <th width="150">Waktu Memulai</th>
                                <th width="150">Waktu Berakhir</th>
                                <th colspan="2">Status</th>
                                <th width="70">Skor</th>
                                <th>Nama Si Pengerja</th>
                                <th>Pemberi Tugas</th>
                                <th>Lainnya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tugasItems as $tugasItem)
                            <tr>
                                <td>{{ $tugasItem->judul }}</td>
                                <td>{{ $tugasItem->deskripsi }}</td>
                                <td>{{ $tugasItem->mulai }}</td>
                                <td>{{ $tugasItem->selesai }}</td>
                                <td colspan="2">
                                    @if ($tugasItem->status == 'Udahdah')
                                    Tugas anda telah selesai
                                    @else
                                        @if ($tugasItem->status == 'Belum Di Kerjakan')
                                        <a href="{{ route('ubahstatus', ['idtugas' => $tugasItem->id, 'status' => 'Belum Di Kerjakan']) }}" class="btn btn-primary">Belum Di Kerjakan</a>
                                        @else
                                        <a href="{{ route('ubahstatus', ['idtugas' => $tugasItem->id, 'status' => 'Belum Di Kerjakan']) }}" class="btn btn-outline-primary">Belum Di Kerjakan</a>
                                        @endif

                                        @if ($tugasItem->status == 'Lagik Di Kerjakan')
                                        <a href="{{ route('ubahstatus', ['idtugas' => $tugasItem->id, 'status' => 'Lagik Di Kerjakan']) }}" class="btn btn-primary">Lagik Di Kerjakan</a>
                                        @else
                                        <a href="{{ route('ubahstatus', ['idtugas' => $tugasItem->id, 'status' => 'Lagik Di Kerjakan']) }}" class="btn btn-outline-primary">Lagik Di Kerjakan</a>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $tugasItem->skor }}</td>
                                <td>{{ $tugasItem->user->name }}</td>
                                <td>{{ $tugasItem->admin->name }}</td>
                                <td>
                                    @if ($tugasItem->status == 'Udahdah')
                                    <a href="" class="btn btn-success">Edit hasil tugas</a>
                                    @else
                                    <a href="" class="btn btn-info">Detail Tugas</a>
                                    <a href="{{ route('tugas.selesai', ['tugasId' => $tugasItem->id]) }}" class="btn btn-success">Selesai</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
