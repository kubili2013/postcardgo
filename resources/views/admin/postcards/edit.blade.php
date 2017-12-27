@title('Postcard')

@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @include('layouts._alerts')
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $title }}</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['admin.postcard.update',$postcard->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-3">--}}
                                {{--<img class="img-circle" src="{{ Auth::user()->gravatarUrl(100) }}">--}}
                                {{--<span class="help-block">Change your avatar on <a href="https://gravatar.com/">Gravatar</a>.</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {!! Form::hidden('id', $postcard->id) !!}

                        @formGroup('country')
                        {!! Form::label('country', null, ['class' => 'col-md-3 control-label']) !!}

                        <div class="col-md-6">
                            {!! Form::text('country', $postcard->country, ['class' => 'form-control country_selector', 'required']) !!}
                            @error('country')
                        </div>
                        @endFormGroup

                        @formGroup('email')
                        {!! Form::label('email', null, ['class' => 'col-md-3 control-label']) !!}

                        <div class="col-md-6">
                            {!! Form::email('email', $postcard->email, ['class' => 'form-control', 'required']) !!}
                            @error('email')
                        </div>
                        @endFormGroup

                        @formGroup('real_name')
                        {!! Form::label('real name', null, ['class' => 'col-md-3 control-label']) !!}

                        <div class="col-md-6">
                            {!! Form::text('real_name', $postcard->real_name, ['class' => 'form-control', 'required']) !!}
                            @error('real_name')
                        </div>
                        @endFormGroup

                        @formGroup('address')
                        {!! Form::label('address', null, ['class' => 'col-md-3 control-label']) !!}

                        <div class="col-md-6">
                            {!! Form::text('address', $postcard->address, ['class' => 'form-control', 'rows' => 3, 'maxlength' => 160]) !!}
                            <span class="help-block">Please</span>
                            @error('address')
                        </div>
                        @endFormGroup

                        @formGroup('postcode')
                        {!! Form::label('postcode', null, ['class' => 'col-md-3 control-label']) !!}

                        <div class="col-md-6">
                            {!! Form::text('postcode', $postcard->postcode, ['class' => 'form-control', 'rows' => 3, 'maxlength' => 160]) !!}
                            <span class="help-block">Please</span>
                            @error('postcode')
                        </div>
                        @endFormGroup

                        @formGroup('message')
                        {!! Form::label('message', null, ['class' => 'col-md-3 control-label']) !!}

                        <div class="col-md-6">
                            {!! Form::textarea('message', $postcard->message, ['class' => 'form-control', 'rows' => 3, 'maxlength' => 160]) !!}
                            <span class="help-block">Please</span>
                            @error('message')
                        </div>
                        @endFormGroup

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-6">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @can(App\Policies\UserPolicy::ADMIN, auth()->user())
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#SendPostcard">Postcard Was Send</button>
                            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#Postcard">Postcard Was Send</button>
                            <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#uploadImage">Upload Image</button>
                        @endcan
                            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#loss">I didn't receive it</button>
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#loss">I have already received it</button>

                    </div>
                </div>
                @can(App\Policies\UserPolicy::ADMIN, auth()->user())
                    <p style="text-align:center"><a href="{{ route('admin.postcards') }}"><i class="fa fa-arrow-left"></i> Back</a></p>
                @endcan
                @cannot(App\Policies\UserPolicy::ADMIN, auth()->user())
                    <p style="text-align:center"><a href="{{ route('dashboard') }}"><i class="fa fa-arrow-left"></i> Back</a></p>
                @endcannot
            </div>
        </div>
    </div>
@endsection
@push('css')
<link href="{{ asset('plugins/country-select/css/countrySelect.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('plugins/country-select/js/countrySelect.min.js') }}"></script>
<script type="text/javascript">
    $(".country_selector").countrySelect({
        preferredCountries: ['ca', 'gb', 'us']
    });
</script>
@endpush