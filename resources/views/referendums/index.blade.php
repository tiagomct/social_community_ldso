@extends('layouts.app')

@section('css')
@endsection

@section('above-navbar')
	@include('partials._breadcrumb', ['mainText' => 'Referendums'])
@endsection

@section('content')
	<div class="col-xs-12 text-right">
		@include('partials._searchable')
	</div>
	@include('partials._list_entries', ['entries' => $referendums])
@endsection