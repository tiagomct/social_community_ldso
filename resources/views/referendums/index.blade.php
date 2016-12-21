@extends('layouts.app')

@section('css')
@endsection

@section('above-navbar')
	@include('partials._breadcrumb', ['mainText' => 'Referendums'])
@endsection

@section('content')
	<div class="col-xs-12 text-right top-actions-container">
		<a href="{{action('ReferendumsController@create')}}" class="btn btn-small-padding btn-create">
			<i class="fa fa-plus"></i> New Referendum
		</a>
		@include('partials._searchable')
	</div>
	@include('partials._list_entries', ['entries' => $referendums, 'likesText' => 'Votes'])
@endsection