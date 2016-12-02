<div class="header">
	<div class="container">
		<div class="logo">
			<a href="{{ url('/') }}"><h1>{{ config('app.name') }}</h1></a>
		</div>
		<div class="navigation">
			<ul>
				<li><a href = "{{ url('/login') }}">Login</a></li>
				<li><a href = "{{ url('/register') }}">Register</a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>