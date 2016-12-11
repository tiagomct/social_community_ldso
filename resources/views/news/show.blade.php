@extends('layouts.app')

@section('content')
	<h5 class = "head">Welcome to {{ $municipality->parish }}</h5>
	<h1>News</h1>
	
	<div class="col-xs-12 text-right">
		@include('partials._searchable')
	</div>
	<hr>
	
	@foreach($newsEntries as $newsEntry)
		<div class = "col-xs-12 border-bottom">
			<div class = "col-xs-12">
				<h2>{{ $newsEntry->title }}</h2>
				<p class = "text-muted">{{ $newsEntry->created_at->diffForHumans() }}</p>
				
				<p class = "ptext">{{ $newsEntry->description }}</p>
				
				<div class = "text-right">
					@include('partials._thumbs', ['likeableType' => 'newsEntry', 'likeable' => $newsEntry])
				</div>
			</div>
		</div>
	@endforeach
	
	<div class = "row">
		<div class = "text-center">
			{{ $newsEntries->links() }}
		</div>
	</div>
@endsection