@extends('layouts.base', ['bodyClass' => 'home'])

@section('body')
    <div class="container">
        @include('layouts._alerts')
    </div>

    <div class="jumbotron text-center">
        <div class="logo"><img src="{{ asset('images/postcardgo.png') }}" title="postcardgo.com"></div>
        <h2>Pay $ 4.99, A Wooden Postcard From China Will Fly To U !</h2>

        <div style="margin-top:40px">
            @if (Auth::guest())
                <a class="btn btn-primary" href="{{ route('register') }}">
                    Join Us
                </a>
                <a class="btn btn-default" href="{{ route('forum') }}">
                    Visit the Forum
                </a>
            @else
                <a class="btn btn-default" href="{{ route('threads.create') }}">
                    Start
                </a>
            @endif
        </div>
    </div>
@endsection
