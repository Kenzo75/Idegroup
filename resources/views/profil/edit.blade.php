@extends('layouts.bar')

@section('title') Edit Profil @endsection
@section('style') <link rel="stylesheet" href="{{ asset('css/form_profil.css') }}"> @endsection

@section('content')
<div class="profil">
    <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="username">
            <div class="biru">
                <h2 class="name" align="center">{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>
                <p>(foto 1:1)</p>
                <label for="file-upload" class="custom-file-upload">
                    <div id="image-preview" class="image-preview"></div>
                    <i class="fa-solid fa-camera"></i>
                </label>
                <input id="file-upload" name="foto" type="file" style="display: none;">
                @error('foto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <script>
                    document.getElementById('file-upload').addEventListener('change', function(event) {
                        var reader = new FileReader();
                        reader.onload = function() {
                            var imagePreview = document.getElementById('image-preview');
                            imagePreview.innerHTML = ''; // Bersihkan konten sebelumnya
                            var image = document.createElement('img');
                            image.src = reader.result;
                            image.style.maxWidth = '100px'; // Sesuaikan lebar gambar jika diperlukan
                            image.style.maxHeight = '100px'; /* Sesuaikan tinggi maksimum gambar */
                            image.style.borderRadius = '50%'; /* Membuat gambar menjadi bulat */
                            imagePreview.appendChild(image);
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    });
                </script>
            </div>
        </div>

            <div class="form">
                <div class="form-container">
                    <div class="form-content-1">
                        <label for="name">Nama</label>
                        <div class="input-box">
                            <input type="text" name="name" id="name" value="{{ $user->name }}">
                        </div>
                        <label for="wa">No. WhatsApp</label>
                        <div class="input-box">
                            <input type="number" name="wa" id="wa" value="{{ $user->wa }}">
                        </div>
                        <label for="gender">Jenis Kelamin</label>
                        <div class="input-box">
                            <input type="text" name="gender" id="gender" value="{{ $user->gender }}">
                        </div>
                        <label for="sekolah">Asal Sekolah</label>
                        <div class="input-box">
                            <input type="text" name="sekolah" id="sekolah" value="{{ $user->sekolah }}">
                        </div>
                    </div>
                    <div class="form-content-2">
                        <label for="instagram">Instagram</label>
                            <div class="input-box">
                                <input type="text" name="instagram" id="instagram" value="{{ $user->instagram }}">
                            </div>
                        <label for="status">Status</label>
                        <div class="input-box">
                            <select name="status" id="status">
                                <option value="" selected hidden></option>
                                <option value="Sad Boy/Girl" {{ $user->status == 'Sad Boy/Girl' ? 'selected' : '' }}>Sad Boy/Girl</option>
                                <option value="PDKT" {{ $user->status == 'PDKT' ? 'selected' : '' }}>PDKT</option>
                                <option value="Bucin" {{ $user->status == 'Bucin' ? 'selected' : '' }}>Bucin</option>
                                <option value="Second Choice" {{ $user->status == 'Second Choice' ? 'selected' : '' }}>Second Choice</option>
                                <option value="LDR" {{ $user->status == 'LDR' ? 'selected' : '' }}>LDR</option>
                                <option value="Cincin 2" {{ $user->status == 'Cincin 2' ? 'selected' : '' }}>Cincin 2</option>
                                <option value="Kepala 3" {{ $user->status == 'Kepala 3' ? 'selected' : '' }}>Kepala 3</option>
                            </select>
                        </div>
                        <label for="kata_mutiara">kata-Kata Mutiara</label>
                            <div class="input-box">
                                <textarea name="kata_mutiara" id="kata_mutiara" cols="30" rows="10">{{ $user->kata_mutiara }}</textarea>
                            </div>
                        <input type="submit" value="submit" class="submit">
                    </div>
                </div>
            </div>
    </form>
</div>

@endsection
