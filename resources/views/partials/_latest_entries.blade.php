<div class="blog_block col-lg-12 padbot50">
	<div class="blog_post margbot50 clearfix col-md-7" data-animated="fadeInUp">
		@if($entries->first()->image)
			<div class="blog_post_img">
				<img src="{{ asset($entries->first()->image) }}" alt="" />
				<a class="zoom" href="{{ entryTypeAction($entries->first()) }}" ></a>
			</div>
		@endif
		<div class="blog_post_descr">
			<div class="blog_post_date">@include('partials._timestamp', ['timestamp' => $entries->first()->created_at])</div>
			<a class="blog_post_title" href="{{ entryTypeAction($entries->first()) }}" >{{ $entries->first()->title }}</a>
			<ul class="blog_post_info">
				@if($entries->first()->comments)<li>{{ $entries->first()->comments->count() }} Comments</li>@endif
				@if($entries->first()->likes)<li>{{ $entries->first()->likes->count() }} Likes</li>@endif
			</ul>
			<hr>
			<div class="blog_post_content">{{ $entries->first()->description }}</div>
			<a class="read_more_btn" href="{{ entryTypeAction($entries->first()) }}" >Read More</a>
		</div>
	</div>
	
	<div class="col-md-5 padbot50">
		@foreach($entries as $entry)
			@if(!$loop->first)
				@include('partials._entry_short_version', ['entry' => $entry])
			@endif
		@endforeach
	</div>
</div>