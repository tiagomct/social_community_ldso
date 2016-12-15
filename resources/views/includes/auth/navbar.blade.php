<header>
	<!-- MENU BLOCK -->
	<div class = "menu_block">
		<!-- CONTAINER -->
		<div class = "container clearfix">
			<!-- LOGO -->
			<div class = "logo pull-left">
				<a class="navbar-brand" href = "{{ url('/') }}">
					<img src = "{{ asset('images/bragança.png') }}" alt = ""/>
				</a>
			</div><!-- //LOGO -->
			
			<!-- MENU -->
			<div class = "pull-right">
				<nav class = "navmenu center">
					<ul>
						<li class = "first scroll_btn"><a href = "{{ action('Auth\LoginController@showLoginForm') }}">Sign In</a></li>
						<li class = "scroll_btn"><a href = "{{ action('Auth\RegisterController@showRegistrationForm') }}">Register</a></li>
					</ul>
				</nav>
			</div><!-- //MENU -->
		</div><!-- //MENU BLOCK -->
	</div><!-- //CONTAINER -->
</header>