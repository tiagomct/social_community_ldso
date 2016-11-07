<div class = "header">
	<div class = "container">
		<div class = "logo">
			<a href = "{{ url('/') }}"><h1>{{ config('app.name') }}</h1></a>
		</div>
		<div class = "pages">
			<ul>
				<li><a href = "index.html">Articles</a></li>
				<li><a href = "3dprinting.html">3D Printers</a></li>
				<li><a class = "active" href = "404.html">Tutorials</a></li>
			</ul>
		</div>
		<div class = "navigation">
			<ul>
				<li><a href = "contact.html">Advertise</a></li>
				<li><a class = "active" href = "about.html">About Us</a></li>
				<li><a href = "contact.html">Contact Us</a></li>
				<li><a href = "{{ url('test-profile-data') }}">User Info</a></li>
			</ul>
		</div>
		<div class = "clearfix"></div>
	</div>
</div>