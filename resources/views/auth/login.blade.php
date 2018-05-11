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
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>

            <div class="reset-password-area">
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>
@stop
