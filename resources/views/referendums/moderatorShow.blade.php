@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 printing-content">
            <div class="print-main">
                <h3>Referendum</h3>
                <a>{{ $referendum->title }}</a>
                <p class="sub_head">Submitted on {{ $referendum->created_at->format('jS F \of Y') }}</p>

                <p class="ptext">{{ $referendum->description }}</p>

                <div class="answers">
                    @foreach($answers as $answer)
                        <div class="col-sm-12 col-xs-12 text-left">
                            <span>{{ $answer->description }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-3 col-sm-3">
            <a href="{{action('ReferendumsController@approve', $referendum->id) }}"
               class="btn btn-primary"><i class="fa fa-check"></i> Approve</a>
        </div>
    </div>
@endsection