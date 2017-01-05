@extends('layouts.app')

@section('content')


    <div class="col-xs-12">
        <div class="forum-entry">
            <span class="text-muted">@include('partials._timestamp', ['timestamp' => $newsEntry->created_at])</span>
            <h2><b>{{ $newsEntry->title }}</b></h2>

            <div class="col-xs-12">
                @if($newsEntry->img_name)
                    <div class="col-xs-2 pull-left user-profile-picture">
                        <img class="img-responsive img-rounded img-border"
                             src="{{ asset('/images/news/'.$newsEntry->img_name) }}">
                    </div>
                @endif

                <div>
                    <p>{{ $newsEntry->description }}</p>
                </div>
            </div>
            <div class="clearfix text-right">
                @include('partials._thumbs', ['likeableType' => 'news', 'likeable' => $newsEntry])
            </div>
        </div>
    </div>
@endsection