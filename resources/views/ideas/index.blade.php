@extends('layouts.app')

@section('css')
@endsection

@section('above-navbar')
	@include('partials._breadcrumb', ['mainText' => 'Ideas'])
@endsection

@section('content')
	<div class="col-xs-12 text-right top-actions-container">
		<a href="{{action('IdeaEntriesController@create')}}" class="btn btn-small-padding btn-create">
			<i class="fa fa-plus"></i> New idea
		</a>
		@include('partials._searchable')
	</div>
	@include('partials._list_entries', ['entries' => $ideas, 'likesText' => 'Votes'])
@endsection