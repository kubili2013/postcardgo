@extends('layouts.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts._alerts')

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $title }}</div>
                    <div class="panel-body">
                        @yield('large-content')
                    </div>
                </div>

                @yield('large-content-after')
            </div>
        </div>
    </div>
@endsection
