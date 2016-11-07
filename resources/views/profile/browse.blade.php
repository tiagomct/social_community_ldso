@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @foreach($users as $user)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-0 col-xs-4 col-xs-offset-3 col-sm-4 col-sm-offset-0">
                                    <img class="thumbnail img-responsive"
                                         src="/storage/uploads/users/{{ $user->img_name}}">
                                </div>

                                <div class="col-md-9 col-xs-12 col-sm-8">
                                    <!--    User name   -->
                                    <h2>{{ $user->name }}</h2>

                                    <!--    Interests   -->
                                    <h4>Interests:</h4>
                                    <p>{{ $user->interests }}</p>

                                    <!--    Politics    -->
                                    <h4>Political opinion: </h4>
                                    <p>{{ $user->politics}}</p>

                                    <a href={{'ProfileController@show', $user->id}} class="btn btn-default">
                                    View
                                    profile </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection