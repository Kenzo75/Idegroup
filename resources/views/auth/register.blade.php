<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/logo,jempol,group.png') }}" type="image/x-icon">
    <title>Idegroup Register</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="{{ asset('css/regis.css') }}">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-web">
        <div class="background">
            <img src="{{ asset('img/bg2.jpeg') }}" alt="" class="bg-1">
        </div>
        <div class="form-content">
            <div class="form-logo">
                <img src="{{ asset('img/jempol.grup.png') }}" alt="" class="logo" id="large-logo">
                <img src="{{ asset('img/jempol.putih.png') }}" alt="" class="logo" id="small-logo">
            </div>
            <div class="form-container">
                <div class="isi-form">
                    <b><h2>Register</h2></b>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <label for="name">Name</label>
                        <div class="input-box">
                            <input id="name" type="text" class="form-req @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Masukan Username anda">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <label for="email">Email</label>
                        <div class="input-box">
                            <input id="email" type="email" class="form-req @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukan Email anda">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="password">Password</label>
                        <div class="input-box">
                            <input id="password" type="password" class="form-req @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukan Password anda">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="password-confirm">Confirm Password</label>
                        <div class="input-box">
                            <input id="password-confirm" type="password" class="form-req" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password anda">
                        </div>
                        <div class="select">
                            <div class="select-box">
                                <label for="role">Tahta</label>
                                <select id="role" class="form-req @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required autocomplete="role">
                                    <option selected hidden value="">Masukan Tahta anda</option>
                                    <option value="admin">Yang Mulia Mentor</option>
                                    <option value="user">Anak Magang</option>
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="select-box" id="user-section" style="display: none;">
                                <label for="team">Bidang</label>
                                <select name="team" id="team" class="form-req">
                                    <option selected hidden value="">Masukan Bidang anda</option>
                                    <option value="Administrator">Tim Administrator</option>
                                    <option value="Programmer">Tim Programmer</option>
                                    <option value="Desainer">Tim Desainer</option>
                                </select>
                            </div>
                        </div>
                        <div class="submit-box">
                            <button type="submit" class="btn-confirm">
                                {{ __('Register') }}
                            </button>
                        </div>
                        <div class="rute-box">
                            <div class="text">Sudah punya akun?</div>
                            <div class="rute"><a href="{{ route('login') }}" class="log-in">Login</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/register.js') }}"></script>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Tahta') }}</label>

                                <div class="col-md-6">
                                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required autocomplete="role">
                                        <option selected hidden value=""></option>
                                        <option value="admin">Yang Mulia Mentor</option>
                                        <option value="user">Anak Magang</option>
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="user-section" style="display: none;">
                            <div class="row mb-3">
                                    <label for="team" class="col-md-4 col-form-label text-md-end">{{ __('Bidang') }}</label>

                                <div class="col-md-6">
                                    <select name="team" id="team" class="form-control">
                                        <option value=""></option>
                                        <option value="Administrator">Tim Administrator</option>
                                        <option value="Programmer">Tim Programmer</option>
                                        <option value="Desainer">Tim Desainer</option>
                                    </select>
                                </div>
                            </div></div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/register.js') }}"></script> --}}
</body>
