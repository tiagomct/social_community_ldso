@extends('layouts.app')

@section('above-navbar')
	@include('partials._fullWidthCarousel')
@endsection

@section('content')
	<h1><b>Latest</b> <span class="golden">News</span></h1>
	@include('partials._latest_entries', ['entries' => $referendums])
	
	<div class="clearfix"></div>
	<h1><b>Latest</b> <span class="red">Referendums</span></h1>
	@include('partials._latest_entries', ['entries' => $referendums])
	
	<div class="clearfix"></div>
	<h1><b>Latest</b> <span class="golden">Ideas</span></h1>
	@include('partials._latest_entries', ['entries' => $ideas])
	
	<div class="clearfix"></div>
	<h1><b>Latest</b> <span class="red">Malfunctions</span></h1>
	@include('partials._latest_entries', ['entries' => $malfunctions])
@endsection