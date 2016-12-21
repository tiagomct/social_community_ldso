<div class = "col-sm-8 comments-section">
	@include('partials._newComment', ['commentableType' => $commentableType, 'commentable' => $commentable])
	
	<div class = "comments-list">
		<h3><b>Comments</b></h3>
		
		<div class="col-xs-12">
			@foreach($comments as $comment)
				<div class="media">
					<div class="media-left">
						<a>
							@if($comment->author->img_name)
								<img class="media-object img-circle" src="{{ asset('images/users/'.$comment->author->img_name) }}" alt="{{ $comment->author->name.' photo' }}">
							@else
								<img class="media-object img-circle" src="{{ asset('images/users/default.jpg') }}" alt="{{ $comment->author->name.' photo' }}">
							@endif
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">{{ $comment->author->name }}</h4>
						<p class="text-muted">
							<small>@include('partials._timestamp', ['timestamp' => $comment->created_at])</small>
						</p>
						
						<p>{{ $comment->description }}</p>
						
						<div class = "col-xs-12 text-right">
							@include('partials._thumbs', ['likeableType' => 'comment', 'likeable' => $comment])
							<span>|</span>
							@include('partials._flags', ['flagableType' => 'comment', 'flagable' => $comment])
						</div>
					</div>
				</div>
			@endforeach
				
			
			@include('partials._pagination', ['entries' => $comments])
		</div>
	</div>
</div>