@extends('layouts.app')

@section('content')
	<div class="col-xs-12">
		<div class="forum-entry">
			<span class="text-muted">@include('partials._timestamp', ['timestamp' => $newsEntry->created_at])</span>
			<h2><b>{{ $newsEntry->title }}</b></h2>
			
			<p>{{ $newsEntry->description }}</p>
			
			<div class="clearfix text-right">
				@include('partials._thumbs', ['likeableType' => 'forum-entry', 'likeable' => $newsEntry])
			</div>
		</div>
	</div>
@endsection