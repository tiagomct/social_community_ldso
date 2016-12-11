@extends('layouts.app')

@section('css')
@endsection

@section('content')
	<div class="col-xs-12 no-padding">
		<h2 class="generic-title text-center">Subscription List</h2>
		
		@foreach($follows as $follow)
			<h4>{{ entryTypeName($follow->entry) }}</h4>
			<div class="col-xs-12 border-bottom">
				<div class="col-xs-12">
					<h2>{{ $follow->entry->title }}</h2>
					<p class="text-muted">{{ $follow->entry->created_at->diffForHumans() }}</p>
					
					<p class="ptext">{{ $follow->entry->description }}</p>
					
					{!! entryTypeShowHtml($follow->entry) !!}
				</div>
			</div>
		@endforeach
		
		<div class="row">
			<div class="text-center">
				{{ $follows->links() }}
			</div>
		</div>
	</div>
@endsection