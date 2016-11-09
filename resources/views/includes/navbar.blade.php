<div class = "header">
	<div class = "container">
		<div class = "logo">
			<a href = "{{ url('/') }}"><h1>{{ config('app.name') }}</h1></a>
		</div>
		<div class = "pages">
			<ul>
				<li><a href = "#">News</a></li>
				<li><a href = "#">Forum</a></li>
				<li><a href = "#">Referendums</a></li>
				<li><a href = "#">Malfunctions</a></li>
			</ul>
		</div>
		<div class = "navigation">
			<ul>
				<li><a href = "{{ action('UsersController@show', auth()->user()->id) }}"><i class="fa fa-user"></i> {{ auth()->user()->name }}</a></li>
				<li><a href = "{{ action('Auth\LoginController@logout') }}"><i class="fa fa-lock"></i> Logout</a></li>
			</ul>
		</div>
		<div class = "clearfix"></div>
	</div>
</div>