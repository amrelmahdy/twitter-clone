@extends('layouts.login')

@section('styles')
    <link rel="stylesheet"  href="{{ URL::to('css/login.css') }}" />
@stop

@section('content')



    <div class="form-login">

        @if($errors->count() > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <form action="{{ route('postLogin') }}" method="POST">
            {{ csrf_field() }}
            <div class="imgcontainer">
                <img src="{{ asset('images/logo.png') }}" alt="Avatar" class="avatar">
            </div>

            <div class="login-area">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Email Or Username" name="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit">Login</button>
               {{-- <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>--}}
            </div>

            <div class="social-login text-center">
                <p style="margin: 10px 0; text-transform: capitalize">you can login with</p>
                <a href="{{ route('loginFacebook') }}">
                    <img src="{{ asset('images/facebook.png') }}" alt="fb">
                </a>
                <span style="margin: 0 10px"></span>
                <a href="{{ route('loginGoogle') }}">
                    <img src="{{ asset('images/google.png') }}" alt="fb">
                </a>
            </div>

            <div class="reset-password-area">
                <span class="psw"><a href="#">Forgot password?</a></span>
            </div>
        </form>
    </div>
@stop
