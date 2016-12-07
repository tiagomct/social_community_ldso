<div class = "col-md-12 single-content-left">
	@include('partials._newComment', ['commentableType' => $commentableType, 'commentable' => $commentable])
	<div class = "comments1">
		<h4>COMMENTS</h4>
		@foreach($comments as $comment)
			<div class = "comments-main">
				<div class = "col-md-3 cmts-main-left">
					<img src="{{ storage_path('app/public/users/'.$comment->author->img_name) }}">
				</div>
				<div class = "col-md-9 cmts-main-right">
					<h5>{{ $comment->author->name }}</h5>
					<p>{{ $comment->description }}</p>
					<div class = "cmts">
						<div class = "col-md-6 cmnts-left">
							<p>
								@if($comment->created_at->isToday() )
									{{ $comment->created_at->diffForHumans() }}
								@else
									{{ $comment->created_at->format('jS F \of Y \a\t H:i') }}
								@endif
							</p>
						</div>
						<div class = "col-md-6 cmnts-right">
							@include('partials._thumbs', ['likeableType' => 'comment', 'likeable' => $comment])
						</div>
						<div class = "clearfix"></div>
					</div>
				</div>
				<div class = "clearfix"></div>
			</div>
		@endforeach
		
		{{ $comments->links() }}
	</div>
</div>