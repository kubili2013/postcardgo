@title('Postcard')

@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item {{ active('admin.dashboard',true) }}">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="list-group-item {{ active('admin.users',true) }}">Users</a>
                    <a href="{{ route('admin.postcards') }}" class="list-group-item {{ active('admin.postcards',true) }}">Postcards</a>

                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $title }}</div>
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
                            {!! Form::email('email', Auth::user()->emailAddress(), ['class' => 'form-control', 'required']) !!}
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

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-6">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
<link href="{{ asset('plugins/country-select/css/countrySelect.css') }}" rel="stylesheet">
@endpush
@push('bottom_script')
<script src="{{ asset('plugins/country-select/js/countrySelect.min.js') }}"></script>
<script type="text/javascript">
    $(".country_selector").countrySelect({
        preferredCountries: ['ca', 'gb', 'us']
    });
</script>
@endpush