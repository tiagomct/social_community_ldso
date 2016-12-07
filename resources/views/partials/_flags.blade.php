@if(!$flagable->isMine())
<a href = "{{action('FlagsController@toggleFlag', [$flagableType, $flagable->id]) }}">
	@if(!$flagable->hasMyReport())
		<span title="Report content as inappropriate">
			<i class = "fa fa-flag-o"></i> Submit report
		</span>
	@else
		<span title="Report content as inappropriate">
			<i class = "fa fa-flag"></i> Cancel report
		</span>
	@endif
</a>
@endif