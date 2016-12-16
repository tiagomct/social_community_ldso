<div class="blog_block col-lg-12 padbot50">
	@foreach($entries as $entry)
	<div class="blog_post margbot50 clearfix col-md-12" data-animated="fadeInUp">
		@if($entry->image)
			<div class="blog_post_img">
				<img src="{{ asset($entry->image) }}" alt="" />
				<a class="zoom" href="{{ entryTypeAction($entry) }}" ></a>
			</div>
		@endif
		<div class="blog_post_descr">
			<div class="blog_post_date">@include('partials._timestamp', ['timestamp' => $entry->created_at])</div>
			<a class="blog_post_title" href="{{ entryTypeAction($entry) }}" >{{ $entry->title }}</a>
			<ul class="blog_post_info">
				@if($entry->comments)<li>{{ $entry->comments->count() }} Comments</li>@endif
				@if($entry->likes)<li>{{ $entry->likes->count() }} Likes</li>@endif
			</ul>
			<hr>
			<div class="blog_post_content">{{ $entry->description }}</div>
			<a class="read_more_btn" href="{{ entryTypeAction($entry) }}" >Read More</a>
		</div>
	</div>
	@endforeach
</div>

@include('partials._pagination', ['entries' => $entries])