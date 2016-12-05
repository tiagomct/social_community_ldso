@if(!$subscriptable->isMine())
<a href = "{{action('SubscriptionsController@toggleSubscription', [$subscriptableType, $subscriptable->id]) }}">
	@if(!$subscriptable->hasMySubscription())
		<i ></i> Follow
	@else
		<i ></i> Unfollow
	@endif
</a>
@endif