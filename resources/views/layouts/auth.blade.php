@extends('layouts.app')

@section('css')
	<link rel = "stylesheet" href = "{{ elixir('css/auth.css') }}"/>
@endsection

@section('content')
	<div class="col-md-8 col-md-offset-2 auth-container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="c-head">@yield('panelTitle')</h3>
			</div>
			<div class="panel-body contact-form">
				@yield('form')
			</div>
		</div>
	</div>
@endsection

@section('js')
@endsection