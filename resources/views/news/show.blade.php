@extends('layouts.app')

@section('content')


    <div class="col-xs-12">
        <div class="forum-entry">
            <span class="text-muted">@include('partials._timestamp', ['timestamp' => $newsEntry->created_at])</span>
            <h2><b>{{ $newsEntry->title }}</b></h2>
            
            @if($newsEntry->image)
                <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                    <div class="col-xs-12 ">
                        <img class="img-responsive img-border" src="{{ asset('/images/news/'.$newsEntry->image) }}">
                    </div>
                </div>
            @endif

            <div class="col-xs-12" style="margin-top: 3em">
                <p>{{ $newsEntry->description }}</p>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="clearfix text-right">
                @include('partials._thumbs', ['likeableType' => 'news', 'likeable' => $newsEntry])
            </div>
        </div>
    </div>
@endsection