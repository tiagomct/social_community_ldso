<div class="footer">
	<div class="footer-top">
		<div class="container">
			<div class="col-md-4 footer-links">
				<h4>Recent Forum Threads</h4>
				@for($i=0; $i < 6; $i++)
					<a href = "#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
				@endfor
			</div>
			<div class="col-md-4 footer-links">
				<h4>Recent News</h4>
				@for($i=0; $i < 6; $i++)
					<a href = "#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
				@endfor
			</div>
			<div class="col-md-4 footer-links">
				<h4>Recent Referendums</h4>
				@for($i=0; $i < 6; $i++)
					<a href = "#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
				@endfor
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="copyrights">
				<p>{{ config('app.name') }} © {{ date('Y') }} All rights reserved | Template by  <a href="http://w3layouts.com" target="_blank">  W3layouts</a></p>
			</div>
		</div>
	</div>
</div>