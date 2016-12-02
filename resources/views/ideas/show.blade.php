@extends('layouts.app')

@section('css')
    <link rel = "stylesheet" href = "{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class = "col-xs-12 printing-content">
        <div class = "print-main">
            <h3>Idea</h3>
            <a>{{ $ideaEntry->title }}</a>
        </div>
    </div>