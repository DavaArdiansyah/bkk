@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <section class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo mb-4 text-center">
                    <img src="" alt="Logo" id="logo" srcset="" light-logo="/assets/static/images/logo/logo-light.png" dark-logo="/assets/static/images/logo/logo-dark.png">
                </div>
                <form action="{{route ('login')}}" method="POST" data-parsley-validate>
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="username" class="form-label d-none">Username</label>
                        <input type="text" name="username" id="username" class="form-control form-control-xl" placeholder="Username" data-parsley-required="true">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="username" class="form-label d-none">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-xl" placeholder="Password" data-parsley-required="true">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                </form>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </section>
@endsection
