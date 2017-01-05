<div class="recent_posts_small clearfix">
	@if($entry->image)
		<div class="post_item_img_small">
			<img src="{{ asset(entryTypeImagePath($entry).$entry->image) }}" alt="" />
		</div>
	@endif
	<div class="post_item_content_small">
		<a class="title" href="{{ entryTypeAction($entry) }}" >{{ $entry->title }}</a>
		<ul class="post_item_inf_small">
			<li>@include('partials._timestamp', ['timestamp' => $entry->created_at])</li>
		</ul>
	</div>
</div>