@extends('layouts.app')

@section('content')
	<div class="col-xs-12">
		<div class="forum-entry">
			<span class="text-muted">@include('partials._timestamp', ['timestamp' => $forumEntry->created_at])</span>
			<h2><b>{{ $forumEntry->title }}</b></h2>
			
			<p>{{ $forumEntry->description }}</p>
			
			<div class="clearfix text-right">
				@include('partials._thumbs', ['likeableType' => 'forum-entry', 'likeable' => $forumEntry])
				<span>|</span>
				@include('partials._follow', ['followableType' => 'forum-entry', 'followable' => $forumEntry])
				<span>|</span>
				@include('partials._flags', ['flagableType' => 'forum-entry', 'flagable' => $forumEntry])
			</div>
		</div>
		
		@include('partials._commentsSections', ['comments' => $comments, 'commentableType' => 'forum-entry', 'commentable' => $forumEntry])
	</div>
@endsection