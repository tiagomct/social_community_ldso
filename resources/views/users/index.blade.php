@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/usersList.css') }}"/>
@endsection

@section('content')
    <div id="users-list" class="col-xs-12 no-padding">
        <h2 class="generic-title text-center">Users List</h2>
        <div class="col-xs-12 text-right">
            @include('partials._searchable')
        </div>
        @foreach($users as $user)
            <div class="col-xs-12 border-bottom user-list-item">
                <div class="col-md-2 col-sm-3 col-xs-12">
                    @if($user->img_name == 'default.jpg')
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/'.$user->img_name) }}">
                    @else
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/users/'.$user->img_name) }}">
                    @endif
                </div>

                <div class="col-md-10 col-sm-9 col-xs-12">
                    <h2 class="user-name">{{ $user->name }}</h2>

                    <dl class="dl-horizontal">
                        <dt>Interests</dt>
                        <dd>{{ $user->interests }}</dd>

                        <dt>Political opinion</dt>
                        <dd>{{ $user->politics}}</dd>
                    </dl>

                    <a href="{{action('UsersController@show', $user->id)}}" class="btn btn-primary pull-right"><i
                                class="fa fa-eye"></i> View profile</a>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="text-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection