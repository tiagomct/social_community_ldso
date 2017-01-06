@extends('layouts.app')

@section('content')
	<div class = "col-xs-12">
		<div class = "referendum">
			<span class = "text-muted">@include('partials._timestamp', ['timestamp' => $referendum->created_at])</span>
			<h2><b>{{ $referendum->title }}</b></h2>
			
			<p>{{ $referendum->description }}</p>
			
			@if($referendum->isClosed())
				<h3 class="text-right">This referendum closed {{ $referendum->closed_at->diffForHumans() }}</h3>
				@include('poll._disabled_poll', ['pollableId' => $referendum->id, 'poll' => $poll, 'pollableType' => 'referendum'])
			@else
				<h3 class="text-right">This referendum closes at {{ $referendum->closed_at }}</h3>
				@include('poll._poll', ['pollableId' => $referendum->id, 'poll' => $poll, 'pollableType' => 'referendum'])
			@endif
			
			<div class = "clearfix text-right">
				@include('partials._follow', ['followableType' => 'referendum', 'followable' => $referendum])
				<span>|</span>
				@include('partials._flags', ['flagableType' => 'referendum', 'flagable' => $referendum])
			</div>
		</div>
		
		@include('partials._commentsSections', ['comments' => $comments, 'commentableType' => 'referendum', 'commentable' => $referendum])
	</div>
@endsection