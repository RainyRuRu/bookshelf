@extends('layouts.app')

@section('content')

    <div class="container">

        <form class="form-auth" method="POST" action="/auth/login">
            <h2 class="form-auth-heading">Please sign in</h2>

            {!! csrf_field() !!}

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <label for="input-username" class="sr-only">Account</label>
            <input type="text" name="username" id="input-username" class="form-control input-top" placeholder="Account" value="{{ old('username') }}" autofocus>

            <label for="input-password" class="sr-only">Password</label>
            <input type="password" name="password" id="input-password" class="form-control input-bottom" placeholder="Password">

            <p><a href="/auth/register">Create account</a></p>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

        </form>

    </div> <!-- /container -->s

@stop
