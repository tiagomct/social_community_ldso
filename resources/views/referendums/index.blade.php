@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col-xs-12 no-padding">
        <h2 class="generic-title text-center">Referendums List</h2>
        <a href="{{action('ReferendumsController@new')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Request a referendum</a>
        @foreach($referendums as $referendum)
            <div class="col-xs-12 border-bottom">
                <div class="col-xs-12">
                    <h2>{{ $referendum->title }}</h2>
                    <p class="text-muted">{{ $referendum->created_at->diffForHumans() }}</p>
                    
                    <p class="ptext">{{ $referendum->description }}</p>
            
                    <a href="{{action('ReferendumsController@show', $referendum->id)}}" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> View referendum</a>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="text-center">
                {{ $referendums->links() }}
            </div>
        </div>
    </div>
@endsection