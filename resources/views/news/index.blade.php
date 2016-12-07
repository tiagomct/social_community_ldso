@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col-xs-12 no-padding">
        <h2 class="generic-title text-center">News List</h2>
        <!--<a href="{{action('NewsEntriesController@create')}}" class="btn btn-primary pull-right"><i
                    class="fa fa-plus"></i> Report a malfunction</a>-->
        @foreach($news as $new)
            <div class="col-xs-12 border-bottom">
                <div class="col-xs-12">
                    <h2>{{ $new->title }}</h2>
                    <h4>by {{ $new->author->name }} - {{ $new->created_at->diffForHumans() }}</h4>
                    <p>{{ str_limit($new->description) }}</p>
                </div>
            </div>
        @endforeach

    </div>
@endsection