@extends('layouts.app')

@section('content')
    <h1>News</h1>

    <div class="col-md-3 col-sm-4 col-xs-12 news-entry-picture">
        @if($new->img_name == 'default.jpg')
            <img class="img-responsive img-thumbnail img-circle" src="{{ asset('/storage/news/'.$new->img_name) }}">
        @else
            <img class="img-responsive img-thumbnail img-circle" src="{{ asset('/storage/uploads/news/'.$new->img_name) }}">
        @endif
    </div>
    <div class = "col-xs-12 printing-content">
        <div class = "print-main">
            <h3>{{ $new->title }}</h3>
            <p class="sub_head">by {{ $new->author->name }} - {{ $new->updated_at->diffForHumans() }}</p>
            <p class = "ptext">{{ $new->description }}</p>
        </div>
    </div>
@endsection