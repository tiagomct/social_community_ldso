@extends('layouts.app')

@section('css')
@endsection

@section('above-navbar')
	@include('partials._breadcrumb', ['mainText' => 'News'])
@endsection

@section('content')
	@include('partials._list_entries', ['entries' => $news, 'likesText' => 'Likes'])
@endsection