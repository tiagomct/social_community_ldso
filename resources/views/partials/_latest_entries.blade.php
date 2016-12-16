<div class="blog_block col-lg-12 padbot50">
	<div class="blog_post margbot50 clearfix col-md-7" data-animated="fadeInUp">
		@if($entries->first()->image)
			<div class="blog_post_img">
				<img src="{{ asset($entries->first()->image) }}" alt="" />
				<a class="zoom" href="{{ entryTypeAction($entries->first()) }}" ></a>
			</div>
		@endif
		<div class="blog_post_descr">
			<div class="blog_post_date">
				@if(isToday($entries->first()->created_at))
					{{ $entries->first()->created_at->diffForHumans() }}
				@else
					{{ $entries->first()->created_at->format('d F Y | H:i') }}
				@endif
			</div>
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
				<div class="recent_posts_small clearfix">
					@if($entry->image)
						<div class="post_item_img_small">
							<img src="{{ asset($entry->image) }}" alt="" />
						</div>
					@endif
					<div class="post_item_content_small">
						<a class="title" href="{{ entryTypeAction($entry) }}" >{{ $entry->title }}</a>
						<ul class="post_item_inf_small">
							<li>
								@if(isToday($entry->created_at))
									{{ $entry->created_at->diffForHumans() }}
								@else
									{{ $entry->created_at->format('d F Y | H:i') }}
								@endif
							</li>
						</ul>
					</div>
				</div>
			@endif
		@endforeach
	</div>
</div>