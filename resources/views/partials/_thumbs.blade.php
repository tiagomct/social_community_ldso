@if(!$likeable->isMine())
<a href = "{{action('LikesController@toggleLike', [$likeableType, $likeable->id]) }}">
	@if(!$likeable->hasMyLike())
		<i class = "fa fa-thumbs-o-up"></i> Like
	@else
		<i class = "fa fa-thumbs-up"></i> Dislike
	@endif
</a>
@endif
<span>{{ $likeable->likes->count() . ' likes' }}</span>