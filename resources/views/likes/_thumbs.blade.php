@if(!$likeable->isMine())
<a href = "{{action('LikesController@toggleLike', [$likeableType, $likeable->id]) }}" class = "btn btn-info btn-xs">
	@if(!$likeable->hasMyLike())
		<i class = "fa fa-thumbs-up"></i> Like
	@else
		<i class = "fa fa-thumbs-up"></i> Dislike
	@endif
</a>
@endif
<span>{{ $likeable->likes->count() . ' likes' }}</span>