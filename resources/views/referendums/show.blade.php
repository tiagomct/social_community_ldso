@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class="col-xs-12 printing-content">
        <div class="print-main">
            <h3>Referendum</h3>
            <a>{{ $referendum->title }}</a>
            <p class="sub_head">Started on {{ $referendum->created_at->format('jS F \of Y') }}</p>
            <p class="ptext">{{ $referendum->description }}</p>

            @include('poll._poll', ['pollableId' => $referendum->id, 'poll' => $poll, 'pollableType' => 'referendum'])
        </div>
        
        @include('partials._commentsSections', ['comments' => $comments, 'commentableType' => 'referendum', 'commentable' => $referendum]))
    </div>
@endsection