@extends('layouts.app')

@section('css')
	<link rel = "stylesheet" href = "{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
	<div class = "col-xs-12 printing-content">
		<div class = "print-main">
			<h3>Referendum</h3>
			<a>{{ $referendum->title }}</a>
			<p class = "sub_head">Started on {{ $referendum->created_at->format('jS F \of Y') }}</p>
			<p class = "ptext">{{ $referendum->description }}</p>
			
			<div class = "referendum-chart">
				@foreach($referendum->pollAnswers as $answer)
					<div class = "chart-bar">
						<div class = "col-sm-5 col-xs-12 text-left">
							<span>{{ $answer->description }}</span>
						</div>
						<div class = "col-sm-5 col-xs-12 text-center">
							<div class = "progress">
								<div class = "progress-bar {{ $answer->hasMyLike() ? '' : 'progress-bar-info' }}"
									 role = "progressbar"
									 aria-valuenow = "{{ $answer->likes->count() }}"
									 aria-valuemin = "0"
									 aria-valuemax = "{{ $answersTotalVotes }}) }}"
									 style = "width: {{ $answersTotalVotes == 0 ? 0 : round($answer->likes->count()*100/$answersTotalVotes, 2) }}%;"
									 data-toggle = "tooltip" data-placement = "top"
									 title = "{{ $answer->likes->count().' of '.$answersTotalVotes }}">
									<span class = "sr-only"></span>
								</div>
							</div>
						</div>
						<div class = "col-sm-2 col-xs-12 text-right">
							@include('likes._thumbs', ['likeableType' => 'answer', 'likeable' => $answer])
						</div>
						<div class = "clearfix"></div>
					</div>
				@endforeach
			</div>
		</div>
		<div class = "print-grids">
			<div class = "print-grid">
				<ul class = "list-group">
					@foreach($comments as $comment)
						<li class = "list-group-item">
							<h4 class = "list-group-item-heading">
								{{ $comment->author->name }}
							</h4>
							<span class = "sub_head">
								@if($comment->created_at->isToday() )
									{{ $comment->created_at->diffForHumans() }}
								@else
									{{ $comment->created_at->format('jS F \of Y \a\t H:i') }}
								@endif
							</span>
							@include('likes._thumbs', ['likeableType' => 'comment', 'likeable' => $comment])
							<p class = "list-group-item-text">
								{{ $comment->description }}
							</p>
						</li>
					@endforeach
				</ul>
				<div class = "row">
					<div class = "text-center">
						{{ $comments->links() }}
					</div>
				</div>
				<div class = "row">
					@include('comments._create', ['commentableType' => 'referendum', 'commentable' => $referendum])
				</div>
			</div>
		</div>
	</div>
@endsection