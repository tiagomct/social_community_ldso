@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col-xs-12 no-padding">
        <h2 class="generic-title text-center">News List</h2>
        <a href="{{action('NewsEntriesController@create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Report a News Story</a>
        @foreach($news as $new)
            <div class="col-md-3 col-sm-4 col-xs-12 news-entry-picture">
                @if($new->img_name == 'default.jpg')
                    <img class="img-responsive img-thumbnail img-circle" src="{{ asset('/storage/news/'.$new->img_name) }}">
                @else
                    <img class="img-responsive img-thumbnail img-circle" src="{{ asset('/storage/uploads/news/'.$new->img_name) }}">
                @endif
            </div>
            <div class="col-xs-12 border-bottom">
                <div class="col-xs-12">
                    <h2>{{ $new->title }}</h2>
                    <p class="text-muted">by {{ $new->author->name }} - {{ $new->updated_at->diffForHumans() }}</p>

                    <p class="ptext">{{ str_limit($new->description,150) }}</p>
                    <a href="{{action('NewsEntriesController@show', $new->id)}}" class="btn btn-primary pull-right"><i
                                class="fa fa-eye"></i> Open News Story</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection