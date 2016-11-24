@extends('layouts.app')

@section('content')
	<h1>Forum</h1>
	<div class = "col-sm-2 col-xs-12 text-right">
	@include('likes.thumbs', ['likeableType' => 'forum-entry', 'likeable' => $forumEntry])
	</div>
	
	<div class = "col-xs-12 printing-content">
		<div class = "print-main">
			<h3>{{ $forumEntry->title }}</h3>
			<p class = "sub_head">Started on {{ $forumEntry->created_at->format('jS F \of Y') }}</p>
			<p class = "ptext">{{ $forumEntry->description }}</p>
		</div>
		@foreach($comments as $comment)
			<div class = "col-xs-12 border-bottom">
				<div class = "col-xs-12">
					<h4>{{$comment->author->name}}</h4>
					<span class = "text-muted">{{ $comment->created_at->diffForHumans() }}</span> -
					@include('likes.thumbs', ['likeableType' => 'comment', 'likeable' => $comment])
					
					<p class = "ptext">{{ $comment->description }}</p>
				</div>
			</div>
		@endforeach
		<form class = "form-horizontal" role = "form" method = "POST"
			  action = "{{action('ForumEntriesController@submitEntry',$forumEntry->id)}}">
			{{ csrf_field() }}
			<div class = "form-group{{ $errors->has('content') ? ' has-error' : '' }}">
				<label for = "description" class = "col-md-4 control-label">Message</label>
				
				<div class = "col-md-6">
					<textarea id = "description" class = "form-control" name = "description"
							  required autofocus>{{ old('description', '') }}</textarea>
					@if ($errors->has('description'))
						<span class = "help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
					@endif
				</div>
			</div>
			
			<div class = "form-group">
				<div class = "col-md-6 col-md-offset-4">
					<input type = "submit" value = "Post"/>
				</div>
			</div>
		</form>
	</div>
@endsection