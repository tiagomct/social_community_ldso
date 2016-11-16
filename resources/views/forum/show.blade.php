@extends('layouts.app')

@section('content')
    <h1>Forum</h1>
    <a href="{{action('ForumsController@create')}}" class="btn btn-primary pull-right"> Create a new Forum</a>

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