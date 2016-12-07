@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class="col-xs-12 printing-content">
        <div class="print-main">
            <h3>Idea</h3>
            <a>{{ $ideaEntry->title }}</a><br>
            <p class="sub_head">Started on {{ $ideaEntry->created_at->format('jS F \of Y') }}</p>
            <p class="ptext">{{$ideaEntry->description}}</p>
	
			@include('partials._voteUp', ['likeableType' => 'idea', 'likeable' => $ideaEntry])
			@include('partials._flags', ['flagableType' => 'idea', 'flagable' => $ideaEntry])
        </div>

        @include('partials._commentsSections', ['comments' => $comments, 'commentableType' => 'idea', 'commentable' => $ideaEntry]))
    </div>
@endsection