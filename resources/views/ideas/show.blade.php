@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class="col-xs-12 printing-content">
        <div class="print-main">
            <h3>Idea</h3>
            <a>{{ $ideaEntry->title }}</a><br>
            <div class="row">
                <div class="pull-right">
                    @include('partials._voteUp', ['likeableType' => 'idea', 'likeable' => $ideaEntry])
                </div>
            </div>
            <p class="sub_head">Started on {{ $ideaEntry->created_at->format('jS F \of Y') }}</p>
            <p class="ptext">{{$ideaEntry->description}}</p>

        </div>

        @include('partials._commentsSections', ['comments' => $comments, 'commentableType' => 'idea', 'commentable' => $ideaEntry]))
    </div>
@endsection