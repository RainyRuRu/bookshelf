@extends('layouts.app')

@section('content')

    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><span>Bookshelf</span></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/auth/logout">登出</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">

        <ul class="list-group">
            @foreach($books as $book)
                <li class="list-group-item clearfix">
                    @if ($book->available)
                        <h3 class="pull-left">{{ $book->name }} <span class="badge alert-success">可借出</span></h3>
                        <form action="/bookshelf/checkout" method="post">
                            {!! csrf_field() !!}
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button class="btn btn-info pull-right" type="submit">借書</button>
                        </form>
                    @else
                        <h3 class="pull-left">{{ $book->name }} <span class="badge alert-danger">已借出</span></h3>                        
                        <form action="/bookshelf/return" method="post">
                            {!! csrf_field() !!}
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            @if ($book->checkoutHistories()->ofUser(app('auth')->user()->id)->count() === 1)
                            <button class="btn btn-info pull-right" type="submit">還書</button>
                            @endif
                        </form>

                    @endif
                </li>
            @endforeach
        </ul>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
    </div>

@stop
