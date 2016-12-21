<div class="projects-wrapper" data-animated="fadeInUp" data-appear-top-offset="-200">
	<!-- PROJECTS SLIDER -->
	<div class="owl-demo owl-carousel projects_slider">
		@for($i=1; $i < 8; $i++)
		<div class="item">
			<div class="work_item">
				<div class="work_img">
					<img class="img-carousel" src="{{ asset('images/carousel/'.$i.'.jpg') }}" alt="" />
				</div>
			</div>
		</div>
		@endfor
	</div><!-- //PROJECTS SLIDER -->
</div>