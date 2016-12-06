@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class="col-xs-12 printing-content">
        <div class="print-main">
            <h3>{{ $malfunction->title }}</h3>
            <div class="row">
                <div class="pull-right">
                    @include('partials._voteUp', ['likeableType' => 'malfunction', 'likeable' => $malfunction])
                </div>
                @if(auth()->user()->isModerator())
                    <div class="pull-right">
                        <a class="btn-sm btn-primary"
                           href="{{action('MalfunctionEntriesController@edit', $malfunction->id)}}"><i
                                    class="fa fa-pencil"></i> Change status </a>
                    </div>
                @endif
            </div>
            <div class="row">
                <div>
                    <a>Submitted by: </a>
                    <p class="ptext">{{ $malfunction->author->name }}</p>
                </div>
                <div>
                    <a>Submitted on:</a>
                    <p class="ptext"> {{ $malfunction->created_at->format('jS F \of Y') }}</p>
                </div>
                <div>
                    <a>Description: </a>
                    <p class="ptext">{{ $malfunction->description }}</p>
                </div>
                <div>
                    <a> Status:</a>
                    <p class="ptext">{{ $malfunction->status }}</p>
                </div>
                @if($malfunction->report)
                    <div>
                        <a>Report:</a>
                        <p class="ptext">{{ $malfunction->report }}</p>
                    </div>
                @endif
            </div>
        </div>
        @include('partials._commentsSections', ['comments' => $comments, 'commentableType' => 'malfunction', 'commentable' => $malfunction]))
    </div>
@endsection