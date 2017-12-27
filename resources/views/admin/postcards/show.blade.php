@title("PostCard " . $postcard->id)

@extends('layouts.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @can(App\Policies\UserPolicy::ADMIN, auth()->user())
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editPostcard">Edit Postcard</button>
                            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deletePostcard">Delete Postcard</button>
                            <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#uploadImage">Upload Image</button>
                        @endcan
                    </div>
                </div>

                <p style="text-align:center"><a href="{{ route('admin.postcards') }}"><i class="fa fa-arrow-left"></i> Back</a></p>
            </div>
            <div class="col-md-9">
                @include('layouts._alerts')

                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('admin.postcards._postcard_info')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
