@inject('latest', 'App\Services\GetLatestPostsFooter')

<!-- CONTACTS -->
<section id="contacts">
</section><!-- //CONTACTS -->

<!-- FOOTER -->
<footer>
	<!-- CONTAINER -->
	<div class="container">
		<!-- ROW -->
		<div class="row" data-appear-top-offset="-200" data-animated="fadeInUp">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padbot30">
				<h4><strong>Recent</strong> Forum Threads</h4>
				
				@foreach($latest->forumThreads() as $forumThread)
					@include('partials._entry_short_version', ['entry' => $forumThread])
				@endforeach
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padbot30">
				<h4><strong>Recent</strong> News</h4>
				
				@foreach($latest->news() as $newsEntry)
					@include('partials._entry_short_version', ['entry' => $newsEntry])
				@endforeach
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padbot30">
				<h4><strong>Recent</strong> Referendums</h4>
				
				@foreach($latest->referendums() as $referendum)
					@include('partials._entry_short_version', ['entry' => $referendum])
				@endforeach
			</div>
		</div><!-- //ROW -->
	</div><!-- //CONTAINER -->
</footer><!-- //FOOTER -->