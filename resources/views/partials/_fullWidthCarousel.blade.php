<div class="projects-wrapper" data-animated="fadeInUp">
	<!-- PROJECTS SLIDER -->
	<div class="owl-demo owl-carousel projects_slider">
		@for($i=1; $i < 8; $i++)
		<div class="item">
			<div class="work_item">
				<div class="work_img">
					<img src="{{ asset('images/carousel/'.$i.'.jpg') }}" alt="" />
				</div>
			</div>
		</div>
		@endfor
	</div><!-- //PROJECTS SLIDER -->
</div>