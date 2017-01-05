@extends('layouts.app')

@section('css')
@endsection

@section('content')

    <div class="col-xs-12">

        @if(auth()->user()->isAdministrator())

            <div class="row">
                <h2>Moderators</h2>
                <p> List and manage who has moderator access</p>
                <a href="{{action('UsersController@index')}}" class="btn btn-sm btn-primary"><i
                            class="fa fa-eye"></i> List users</a>
            </div>

            <hr>
        @endif

        <div class="row">
            <h2>Referendums</h2>
            <p> List and manage pending referendum requests</p>
            <a href="{{action('ReferendumsController@pendingList')}}" class="btn btn-sm btn-primary"><i
                        class="fa fa-eye"></i> Show pending</a>
        </div>

        <hr>

        <div class="row">
            <h2>Malfunctions</h2>
            <p> Show pending malfunctions and update their status </p>
            <a href="{{action('MalfunctionEntriesController@index', 'pending' )}}" class="btn btn-sm btn-primary"><i
                        class="fa fa-eye"></i> Show pending</a>
        </div>

        <hr>
    </div>


@endsection