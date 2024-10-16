@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <section class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo mb-4 text-center">
                    <img src="" alt="Logo" id="logo" srcset=""
                        light-logo="/assets/static/images/logo/logo-light.png"
                        dark-logo="/assets/static/images/logo/logo-dark.png">
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="username" class="form-label d-none">Username</label>
                        <input type="text" name="username" id="username"
                            class="form-control form-control-xl @error('username') is-invalid @enderror"
                            placeholder="Username" value="{{ old('username') }}">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        @error('username')
                            <span class="invalid-feedback d-block mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="password" class="form-label d-none">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control form-control-xl @error('password') is-invalid @enderror"
                            placeholder="Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password')
                            <span class="invalid-feedback d-block mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Log in</button>
                </form>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
                <!-- Optional background or right-side content -->
            </div>
        </div>
    </section>
@endsection
