@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col-xs-12 no-padding">
        <h2 class="generic-title text-center">Forum List</h2>
        <a href="{{action('ForumEntriesController@create')}}" class="btn btn-primary pull-right"> Create a new Forum</a>
        @foreach($forums as $forum)
            <div class="col-xs-12 border-bottom">
                <div class="col-xs-12">
                    <h2>{{ $forum->title }}</h2>
                    <p class="text-muted">{{ $forum->created_at->diffForHumans() }}</p>

                    <p class="ptext">{{ $forum->description }}</p>
					
                    <a href="{{action('ForumEntriesController@show', $forum->id)}}" class="btn btn-primary pull-right"><i
                                class="fa fa-eye"></i> Open Forum</a>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="text-center">
                {{ $forums->links() }}
            </div>
        </div>
    </div>
@endsection