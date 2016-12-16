@extends('layouts.app')

@section('css')
@endsection

@section('above-navbar')
	@include('partials._breadcrumb', ['mainText' => 'Forum Topics'])
@endsection

@section('content')
	<div class="col-xs-12 text-right top-actions-container">
		<a href="{{action('ForumEntriesController@create')}}" class="btn btn-create">
			<i class="fa fa-plus"></i> New Topic
		</a>
		@include('partials._searchable')
	</div>
	@include('partials._list_entries', ['entries' => $forums, 'likesText' => 'Likes'])
@endsection