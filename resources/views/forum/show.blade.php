@extends('layouts.app')

@section('content')
	<h1>Forum</h1>
	<div class = "col-sm-2 col-xs-12 text-right">
		@include('partials._thumbs', ['likeableType' => 'forum-entry', 'likeable' => $forumEntry])
	</div>
	
	<div class = "col-xs-12 printing-content">
		<div class = "print-main">
			<h3>{{ $forumEntry->title }}</h3>
			<p class = "sub_head">Started on {{ $forumEntry->created_at->format('jS F \of Y') }}</p>
			<p class = "ptext">{{ $forumEntry->description }}</p>
		</div>
		@foreach($comments as $comment)
			<div class = "col-xs-12 border-bottom">
				<div class = "col-xs-12">
					<h4>{{$comment->author->name}}</h4>
					<span class = "text-muted">{{ $comment->created_at->diffForHumans() }}</span> -
					@include('partials._thumbs', ['likeableType' => 'comment', 'likeable' => $comment])
					
					<p class = "ptext">{{ $comment->description }}</p>
				</div>
			</div>
		@endforeach
		
		@include('partials._create', ['commentableType' => 'forum-entry', 'commentable' => $forumEntry])
	</div>
@endsection