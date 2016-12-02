@extends('layouts.app')

@section('css')
    <link rel = "stylesheet" href = "{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class = "col-xs-12 printing-content">
        <div class = "print-main">
            <h3>Idea</h3>
            <a>{{ $ideaEntry->title }}</a><br>
            <p class = "sub_head">Started on {{ $ideaEntry->created_at->format('jS F \of Y') }}</p>
            <p class="ptext">{{$ideaEntry->description}}</p>

            <div class = "referendum-chart">
                @foreach($ideaEntry->pollAnswers as $answer)
                    <div class = "chart-bar">
                        <div class = "col-sm-5 col-xs-12 text-left">
                            <span>{{ $answer->description }}</span>
                        </div>
                        <div class = "col-sm-5 col-xs-12 text-center">
                            <div class = "progress">
                                <div class = "progress-bar {{ $answer->hasMyLike() ? '' : 'progress-bar-info' }}"
                                     role = "progressbar">
                                    <span class = "sr-only"></span>
                                </div>
                            </div>
                        </div>
                        <div class = "col-sm-2 col-xs-12 text-right">
                            @include('likes._thumbs', ['likeableType' => 'answer', 'likeable' => $answer])
                        </div>
                        <div class = "clearfix"></div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection