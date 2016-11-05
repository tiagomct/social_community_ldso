@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-3 col-md-offset-0 col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-0">
            <!--    Profile pic     -->
            <img class="img-rounded img-responsive" src="/storage/uploads/users/{{ $user->img_name}}">
        </div>

        <div class="col-md-9 col-xs-12 col-sm-8">
            <ul class="list-group">

                <!--    User name   -->
                <li class="list-group-item">
                <h2>{{ $user->name }}</h2>
                </li>

                <!--    Email   -->
                @if($user->id==Auth::user()->id)
                    <li class="list-group-item">
                        <h4> Email:</h4>
                        <p>{{ $user->email }}</p>
                    </li>
                @endif

                <!--    Created at  -->
                <li class="list-group-item">
                    <h4>Date joined:</h4>
                    <p>{{ $user->created_at }}</p>
                </li>

                <!--    Description -->
                <li class="list-group-item">
                    <h4> About me: </h4>
                    <p>{{ $user->description }}</p>
                </li>

                <!--    Politics    -->
                <li class="list-group-item">
                    <h4>Political opinion: </h4>
                    <p>{{ $user->politics}}</p>
                </li>

                <!--    Interests   -->
                <li class="list-group-item">
                    <h4>Interests:</h4>
                    <p>{{ $user->interests }}</p>
                </li>
            </ul>


            <!--    Edit button -->
            @if($user->id==Auth::user()->id)
                <a href={{url('/user/edit')}} class="btn btn-default pull-right"> Change profile </a>
            @endif

        </div>
    </div>

@endsection