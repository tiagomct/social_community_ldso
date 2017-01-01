@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="malfunction">
            <span class="text-muted">@include('partials._timestamp', ['timestamp' => $malfunction->created_at])</span>
            <h2><b>{{ $malfunction->title }}</b></h2>

            <p>{{ $malfunction->description }}</p>

            <p><strong>Author: </strong>{{ $malfunction->author->name }}</p>
            <p><strong>Status: </strong>{{ $malfunction->status }}</p>
            @if($malfunction->report)
                <p><strong>Report: </strong>{{ $malfunction->report }}</p>
            @endif

            @if(auth()->user()->isModerator())
                <a href="{{action('MalfunctionEntriesController@edit', $malfunction->id )}}" class="btn btn-sm btn-primary pull-left"><i
                            class="fa fa-eye"></i> Edit </a>
            @endif

            <div class="clearfix text-right">
                @include('partials._voteUp', ['likeableType' => 'malfunction', 'likeable' => $malfunction])
                <span>|</span>
                @include('partials._follow', ['followableType' => 'malfunction', 'followable' => $malfunction])
                <span>|</span>
                @include('partials._flags', ['flagableType' => 'malfunction', 'flagable' => $malfunction])
            </div>
        </div>

        @include('partials._commentsSections', ['comments' => $comments, 'commentableType' => 'referendum', 'commentable' => $malfunction])
    </div>
@endsection