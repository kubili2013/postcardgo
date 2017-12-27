@title('Users')

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
                <div class="panel panel-default panel-search">
                    <div class="panel-heading">
                        Users
                        {{ Form::open(['route' => 'admin.dashboard', 'method' => 'GET']) }}
                            <div class="input-group">
                                {{ Form::text('search', $search ?? null, ['class' => 'form-control', 'placeholder' => 'Search for users...']) }}
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        {{ Form::close() }}
                    </div>

                    <table class="table table-striped table-sort">
                        <thead>
                            <tr>
                                <th>Joined On</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="text-center">

                </div>
            </div>
        </div>
    </div>
@endsection
