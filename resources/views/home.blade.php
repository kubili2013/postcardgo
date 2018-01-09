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
    <div class="jumbotron text-center">
        <h2>Pay $ 4.99, A Wooden Postcard From China Will Fly To U !</h2>
        <div class="panel panel-default">
            <div class="panel-heading">I want to a postcard!</div>
            <div class="panel-body">
                {!! Form::open(['route' => 'admin.postcard.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                {{--<div class="form-group">--}}
                {{--<div class="col-md-6 col-md-offset-3">--}}
                {{--<img class="img-circle" src="{{ Auth::user()->gravatarUrl(100) }}">--}}
                {{--<span class="help-block">Change your avatar on <a href="https://gravatar.com/">Gravatar</a>.</span>--}}
                {{--</div>--}}
                {{--</div>--}}

                @formGroup('country')
                {!! Form::label('country', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::text('country', "", ['class' => 'form-control country_selector', 'required']) !!}
                    @error('country')
                </div>
                @endFormGroup

                @formGroup('email')
                {!! Form::label('email', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::email('email', Auth::check() ? Auth::user()->emailAddress() : '', ['class' => 'form-control', 'required']) !!}
                    @error('email')
                </div>
                @endFormGroup

                @formGroup('real_name')
                {!! Form::label('real name', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::text('real_name', "", ['class' => 'form-control', 'required']) !!}
                    @error('real_name')
                </div>
                @endFormGroup

                @formGroup('address')
                {!! Form::label('address', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::text('address', "", ['class' => 'form-control', 'rows' => 3, 'maxlength' => 160]) !!}
                    <span class="help-block">Please</span>
                    @error('address')
                </div>
                @endFormGroup

                @formGroup('postcode')
                {!! Form::label('postcode', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::text('postcode', "", ['class' => 'form-control', 'rows' => 3, 'maxlength' => 160]) !!}
                    <span class="help-block">Please</span>
                    @error('postcode')
                </div>
                @endFormGroup

                @formGroup('message')
                {!! Form::label('message', null, ['class' => 'col-md-3 control-label']) !!}

                <div class="col-md-6">
                    {!! Form::textarea('message', "", ['class' => 'form-control', 'rows' => 3, 'maxlength' => 160]) !!}
                    <span class="help-block">Please</span>
                    @error('message')
                </div>
                @endFormGroup

                {!! Form::close() !!}
                <div id="paypal-button-container"></div>
                <script>
                    paypal.Button.render({
                        env: '{{config('paypal.mode')}}', // sandbox | production
                        commit: true,
                        style: {
                            label: 'buynow',
                            fundingicons: true, // optional
                            branding: true, // optional
                            size:  'large', // small | medium | large | responsive
                            shape: 'rect',   // pill | rect
                            color: 'black'   // gold | blue | silve | black
                        },
                        payment: function() {
                            var CREATE_URL = '{{route('paypal.payment.create')}}';
                            return paypal.request.post(CREATE_URL)
                                    .then(function(res) {
                                        return res.id;
                                    });
                        },
                        onAuthorize: function(data, actions) {
                            debugger;
                            var EXECUTE_URL = '{{route('paypal.payment.execute')}}';
                            var data = {
                                paymentID: data.paymentID,
                                payerID: data.payerID
                            };
                            return paypal.request.post(EXECUTE_URL, data)
                                    .then(function (res) {
                                        debugger;
                                        window.alert('Payment Complete!');
                                    });
                        }

                    }, '#paypal-button-container');
                </script>
            </div>
        </div>
    </div>
@endsection

@push('top_script')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
@endpush