@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col-xs-12 no-padding">
        <h2 class="generic-title text-center">Ideas List</h2>
        <!--<a href="{{action('IdeaEntriesController@create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Request a referendum</a>-->
        @foreach($ideas as $idea)
            <div class="col-xs-12 border-bottom">
                <div class="col-xs-12">
                    <h2>{{ $idea->title }}</h2>
                    <p class="text-muted">{{ $idea->created_at->diffForHumans() }}</p>

                    <p class="ptext">{{ $idea->description }}</p>

                    <a href="{{action('IdeaEntriesController@show', $idea->id)}}" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> View idea </a>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="text-center">
                {{ $ideas->links() }}
            </div>
        </div>
    </div>
@endsection