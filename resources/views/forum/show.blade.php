@extends('layouts.app')

@section('content')
	<h1>Forum</h1>
	
	<div class = "col-xs-12 printing-content">
		<div class = "print-main">
			<h3>{{ $forumEntry->title }}</h3>
			<p class = "sub_head">Started on {{ $forumEntry->created_at->format('jS F \of Y') }}</p>
			<p class = "ptext">{{ $forumEntry->description }}</p>
			
			<div class = "col-xs-12 text-right">
				@include('partials._thumbs', ['likeableType' => 'forum-entry', 'likeable' => $forumEntry])
				<span style="margin-left: 15px;"></span>
				@include('partials._flags', ['flagableType' => 'forum-entry', 'flagable' => $forumEntry])
			</div>
		</div>
		
		@include('partials._commentsSections', ['commentableType' => 'forum-entry', 'commentable' => $forumEntry])
	</div>
@endsection