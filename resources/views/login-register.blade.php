@extends('layouts.main')

@section('style')
    <style>
        nav,
        footer,
        .navbar-margin-bottom,
        .loading-animation {
            display: none !important;
            margin-top: 0 !important;
        }

        body {
            background: var(--blue-green-gradient-bg) !important;
        }
    </style>
@endsection

@section('main')
    <div class="login-register-main">
        <!-- login-register-left  -->
        <div class="login-register-left-box">
            <div class="cover-left-box">
                <a href="/">
                    <img src="/img/swiftwalk-logo-alpha.png" alt="Swiftwalk Logo" class="logo rounded-5" />
                </a>
                <p>Temukan sneaker lokal impianmu hanya di Swiftwalk</p>
                <img src="/img/login-register-vector.png" alt="" class="login-register-cover" />
            </div>
        </div>
        <!-- login-register-right  -->
        <div class="login-register-right-box animate__animated animate__fadeInRight">
            <div class="row center-all">
                <div class="form-box shadow">
                    <h1 class="mt-4 mb-3">{{ $title }}</h1>
                    @if ($page == 'login')
                        {{-- login --}}
                        <form class="login-register-form" action="/login" method="POST">
                            @csrf
                            <div class="input-group input-group-lg mb-3">
                                <span class="input-group-text no-border bg-white">
                                    <i class="fa-solid fa-at"></i>
                                </span>
                                <input required name="email" type="email" class="form-control no-border"
                                    placeholder="Email" />
                            </div>
                            <div class="input-group input-group-lg mb-3">
                                <span class="input-group-text no-border bg-white">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input required name="password" type="password" class="form-control no-border"
                                    placeholder="Password" />
                            </div>
                            <div class="form-check mb-2 text-start">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" id="login" class="login-register-btn mb-2"><i
                                    class="fa-solid fa-arrow-right-to-bracket"></i> Login</button>
                        </form>
                    @else
                        {{-- register --}}
                        <form class="login-register-form" action="/register" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text no-border bg-white">
                                    <i class="fa-solid fa-at"></i>
                                </span>
                                <input required name="email" type="email"
                                    class="form-control no-border @error('email') is-invalid @enderror" placeholder="Email"
                                    value="{{ old('email') }}" />
                                @error('email')
                                    <div class="text-danger text-start w-100" style="font-size: 13px">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="input-group mb-3">
                                <span class="input-group-text no-border bg-white">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input required name="username" type="text"
                                    class="form-control no-border @error('username') is-invalid @enderror"
                                    placeholder="Username" value="{{ old('username') }}" />
                                @error('username')
                                    <div class="text-danger text-start w-100" style="font-size: 13px">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="input-group mb-3">
                                <span class="input-group-text no-border bg-white">
                                    <i class="fa-solid fa-venus-mars"></i>
                                </span>
                                <select required name="gender" id="gender"
                                    class="form-select no-border gender-select-form">
                                    <option value="" selected>Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>


                            <div class="input-group mb-3">
                                <span class="input-group-text no-border bg-white">
                                    <i class="fa-solid fa-phone"></i>
                                </span>
                                <input required name="number" type="text"
                                    class="form-control no-border @error('number') is-invalid @enderror"
                                    placeholder="Phone Number" value="{{ old('number') }}" />
                                @error('number')
                                    <div class="text-danger text-start w-100" style="font-size: 13px">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="input-group mb-3">
                                <span class="input-group-text no-border bg-white">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input required name="password" type="password"
                                    class="form-control no-border @error('password') is-invalid @enderror"
                                    placeholder="Password" />
                                @error('password')
                                    <div class="text-danger text-start w-100" style="font-size: 13px">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="input-group mb-3">
                                <span class="input-group-text no-border bg-white">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                                <input required name="password_confirmation" type="password"
                                    class="form-control no-border @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Konfimasi Password" />
                                @error('password_confirmation')
                                    <div class="text-danger text-start w-100" style="font-size: 13px">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-check mb-2 text-start">
                                <input required class="form-check-input" type="checkbox" name="terms" id="remember">
                                <h6>Saya setuju dengan
                                    <a href="https://policies.google.com/terms" target="_blank" class="text-primary">syarat dan ketentuan</a>
                                </h6>
                            </div>


                            <button type="submit" id="register" class="login-register-btn mt-3 mb-2"><i
                                    class="fa-regular fa-memo-circle-check"></i> Daftar</button>
                        </form>
                    @endif
                    <p>ATAU</p>
                    <div class="social">
                        <span>
                            <a href="https://accounts.google.com/" target="_blank"><img src="/img/google.png"
                                    alt="google" /></a>
                        </span>
                        <span class="fs-3 px-2"><i class="fa-solid fa-pipe"></i></span>
                        <span>
                            <a href="https://www.facebook.com/login/" target="_blank"><img src="/img/facebook.png"
                                    alt="facebook" /></a>
                        </span>
                    </div>
                    @if ($page == 'login')
                        <p>Belum memiliki akun? <a id="login_register_badge"
                                class="badge blue-green-gradient-bg rounded-pill" href="/register">Daftar</a></p>
                    @else
                        <p>Sudah memiliki akun? <a id="login_register_badge"
                                class="badge cyan-blue-gradient-bg rounded-pill" href="/login">Login</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
