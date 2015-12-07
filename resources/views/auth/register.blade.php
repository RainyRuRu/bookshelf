@extends('layouts.app')

@section('content')
    <div class="container">

        <form class="form-auth" method="POST" action="/auth/register">

            <h2 class="form-auth-heading">Create account</h2>

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! csrf_field() !!}

            <label for="input-username" class="sr-only">Name</label>
            <input type="text" name="username" id="input-name" class="form-control input-top" placeholder="Name" value="{{ old('name') }}" autofocus>

            <label for="input-password" class="sr-only">Password</label>
            <input type="password" name="password" id="input-password" class="form-control input-middle" placeholder="Password">

            <label for="input-password" class="sr-only">Confirm Password</label>
            <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control input-bottom" placeholder="Confirm Password">

            <p><a href="/auth/login">Have account already?</a></p>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>
    </div>

@stop