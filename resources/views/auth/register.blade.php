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

        <form action="{{ route('postRegister') }}" method="POST">
            {{ csrf_field() }}
            <div class="imgcontainer">
                <img src="{{ asset('images/logo.png') }}" alt="Avatar" class="avatar">
            </div>

            <div class="login-area">
                <label for="name"><b>Name</b></label>
                <input id="name" type="text" placeholder="name" name="name" required>

                <label for="email"><b>Email</b></label>
                <input id="email" type="text" placeholder="email" name="email" required>

                <label for="username"><b>Username</b></label>
                <input id="username" type="text" placeholder="username" name="username" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="conform Password" name="password_confirmation" required>

                <button type="submit">Register</button>
                {{-- <label>
                     <input type="checkbox" checked="checked" name="remember"> Remember me
                 </label>--}}
            </div>

        </form>
    </div>
@stop
