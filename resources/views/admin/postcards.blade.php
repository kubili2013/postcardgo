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
                        Postcard
                        {{ Form::open(['route' => 'admin.users', 'method' => 'GET']) }}
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
                                <th>Country</th>
                                {{--<th>Address</th>--}}
                                <th>Postcode</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postcards as $postcard)
                                <tr>
                                    <td>{{ $postcard->created_at->diffForHumans() }}</td>
                                    <td>{{ $postcard->real_name }}</td>
                                    <td>{{ $postcard->country }}</td>
                                    {{--<td>{{ $postcard->address }}</td>--}}
                                    <td>{{ $postcard->postcode }}</td>
                                    <td>{{ $postcard->email }}</td>
                                    <td>
                                        @if ($postcard->status == 'created')
                                            <span class="label label-warning">{{$postcard->status}}</span>
                                        @elseif ($postcard->status == 'paid')
                                            <span class="label label-primary">{{$postcard->status}}</span>
                                        @elseif ($postcard->status == 'sent')
                                            <span class="label label-default">{{$postcard->status}}</span>
                                        @elseif ($postcard->status == 'missing')
                                            <span class="label label-danger">{{$postcard->status}}</span>
                                        @endif
                                    </td>
                                    <td style="text-align:center;">
                                        <a href="{{ route('admin.postcard.show', $postcard->id) }}" class="btn btn-xs btn-link">
                                            <i class="fa fa-gear"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    {!! $postcards->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
