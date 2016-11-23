@extends('layouts.app')

@section('content')
    <h1>Forum</h1>
    <div class="col-sm-2 col-xs-12 text-right">
        @if(!$userLikeId)
            <a href="{{action('ForumsController@submitLike', [$forum->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-thumbs-up"></i> Like </a>
        @else
                <a href="{{action('ForumsController@submitDeslike', [$forum->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-thumbs-up"></i> Deslike </a>
        @endif
        <span>{{ $totalLikes . ' likes' }}</span>
    </div>

    <div class="col-xs-12 printing-content">
        <div class="print-main">
            <h3>{{ $forum->title }}</h3>
            <p class="sub_head">Started on {{ $forum->created_at->format('jS F \of Y') }}</p>
            <p class="ptext">{{ $forum->description }}</p>
        </div>
        @foreach($entries as $entry)
            <div class="col-xs-12 border-bottom">
                <div class="col-xs-12">
                    <h4>{{$entry->user->name}}</h4>
                    <p class="text-muted">{{ $entry->created_at->diffForHumans() }}</p>

                    <p class="ptext">{{ $entry->content }}</p>
                </div>
            </div>
        <!--<div class="col-sm-2 col-xs-12 text-right">
                @if(!$userentryLikeId)
                    <a href="{{action('ForumsController@submitLikeEntry', [$entry->id, $forum->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-thumbs-up"></i> Like </a>
                @else
                    <a href="{{action('ForumsController@submitDeslikeEntry', [$entry->id, $forum->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-thumbs-up"></i> Deslike </a>
                @endif
               <span>{{ $totalEntryLikes . ' likes' }}</span>
            </div>-->
        @endforeach
        <form class="form-horizontal" role="form" method="POST"
              action="{{action('ForumsController@submitEntry',$forum->id)}}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                <label for="content" class="col-md-4 control-label">Message</label>

                <div class="col-md-6">
                    <input id="content" type="text" class="form-control" name="content" value="{{ old('content') }}"
                           required autofocus>

                    @if ($errors->has('content'))
                        <span class="help-block">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <input type="submit" value="Post"/>
                </div>
            </div>
        </form>
    </div>
@endsection