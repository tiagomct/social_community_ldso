@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12 col-xs-12 col-sm-12">
                <ul class="list-group">

                    <!--    Title   -->
                    <li class="list-group-item">
                        <h2>{{ $referendum->title }}</h2>
                    </li>

                    <!--    Created at  -->
                    <li class="list-group-item">
                        <h4>Date joined:</h4>
                        <p>{{ $referendum->created_at }}</p>
                    </li>

                    <!--    Description -->
                    <li class="list-group-item">
                        <h4> Description: </h4>
                        <p>{{ $referendum->description }}</p>
                    </li>
                </ul>

                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6 col-md-offset-2 col-sm-offset-2 col-xs-offset-3 text-center">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4>Support</h4>
                            </div>
                            <div class="panel-body">
                                <h2>{{ $upVotes }}</h2>
                                @if($voted==False)
                                    <a href={{action('ReferendumController@voteUp', $referendum->id)}} class="btn
                                       btn-success">
                                    Support </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-6 col-md-offset-2 col-sm-offset-2 col-xs-offset-3 text-center">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4>Disapprove</h4>
                            </div>
                            <div class="panel-body">
                                <h2>{{ $downVotes }}</h2>
                                @if($voted==False)
                                    <a href={{action('ReferendumController@voteDown', $referendum->id)}} class="btn
                                       btn-danger">
                                    Disapprove </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection