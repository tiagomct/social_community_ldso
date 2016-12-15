@extends('layouts.app')

@section('above-navbar')
	@include('partials._fullWidthCarousel')
@endsection

@section('content')
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