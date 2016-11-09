@extends('layouts.app')

@section('css')
    <link rel = "stylesheet" href = "{{ elixir('css/usersList.css') }}"/>
@endsection

@section('content')
    <div id="users-list" class="col-xs-12 no-padding">
        <h2 class="generic-title text-center">Users List</h2>
        
        @foreach($users as $user)
            <div class="col-xs-12 border-bottom user-list-item">
                <div class="col-md-2 col-sm-3 col-xs-12">
                    <img class="thumbnail img-responsive img-thumbnail" src="{{ asset('storage/uploads/users/'.$user->img_name)}}">
                </div>
        
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <h2 class="user-name">{{ $user->name }}</h2>
            
                    <dl class="dl-horizontal">
                        <dt>Interests</dt>
                        <dd>{{ $user->interests }}</dd>
                
                        <dt>Political opinion</dt>
                        <dd>{{ $user->politics}}</dd>
                    </dl>
            
                    <a href="{{action('UsersController@show', $user->id)}}" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> View profile</a>
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