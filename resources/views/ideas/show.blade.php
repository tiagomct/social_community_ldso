@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="idea">
            <span class="text-muted">@include('partials._timestamp', ['timestamp' => $ideaEntry->created_at])</span>
            <h2><b>{{ $ideaEntry->title }}</b></h2>
        
            <p>{{ $ideaEntry->description }}</p>
        
            <div class="clearfix text-right">
                @include('partials._voteUp', ['likeableType' => 'idea', 'likeable' => $ideaEntry])
                <span>|</span>
                @include('partials._follow', ['followableType' => 'idea', 'followable' => $ideaEntry])
                <span>|</span>
                @include('partials._flags', ['flagableType' => 'idea', 'flagable' => $ideaEntry])
            </div>
        </div>
    
        @include('partials._commentsSections', ['comments' => $comments, 'commentableType' => 'idea', 'commentable' => $ideaEntry])
    </div>
@endsection