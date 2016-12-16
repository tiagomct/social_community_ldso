@if(!$followable->isMine())
<a class="golden" href = "{{action('FollowsController@toggleFollow', [$followableType, $followable->id]) }}">
	@if(!$followable->hasMyFollow())
		<span title="Report content as inappropriate">
			<i class = "fa fa-rss-square"></i> Subscribe
		</span>
	@else
		<span title="Report content as inappropriate">
			<i class = "fa fa-times-circle"></i> Unsubscribe
		</span>
	@endif
</a>
@endif