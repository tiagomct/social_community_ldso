@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class="col-xs-12 printing-content">
        <div class="print-main">
            <h3>Idea</h3>
            <a>{{ $ideaEntry->title }}</a><br>
            <p class="sub_head">Started on {{ $ideaEntry->created_at->format('jS F \of Y') }}</p>
            <p class="ptext">{{$ideaEntry->description}}</p>

            @include('poll._poll', ['pollableId' => $ideaEntry->id, 'poll' => $poll, 'pollableType' => 'idea'])

        </div>

        @include('partials._commentsSections', ['comments' => $comments, 'commentable' => $ideaEntry]))
    </div>
@endsection