@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="referendum">
            <span class="text-muted">@include('partials._timestamp', ['timestamp' => $referendum->created_at])</span>
            <h2><b>{{ $referendum->title }}</b></h2>

            <h3> Description </h3>
            <p>{{ $referendum->description }}</p>
            <p class="ptext">{{ $referendum->description }}</p>

            <div class="answers">
                <h3>Answers</h3>
                @foreach($answers as $answer)
                    <span>{{ $answer->description }}</span>
                    <hr>
                @endforeach
            </div>

            <a href="{{action('ReferendumsController@approve', $referendum->id) }}"
               class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Approve</a>

        </div>
    </div>
@endsection