<header>
    <!-- MENU BLOCK -->
    <div class="menu_block">
        <!-- CONTAINER -->
        <div class="container clearfix">
            <!-- LOGO -->
            <div class="logo pull-left">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/bragança.png') }}" alt=""/>
                </a>
            </div><!-- //LOGO -->

            <!-- SEARCH FORM -->
            <!--<div id = "search-form" class = "pull-right">
                <form method = "get" action = "#">
                    <input type = "text" name = "Search" value = "Search" onFocus = "if (this.value == 'Search') this.value = '';" onBlur = "if (this.value == '') this.value = 'Search';"/>
                </form>
            </div>--><!-- SEARCH FORM -->

            <!-- MENU -->
            <div class="pull-right">
                <nav class="navmenu center">
                    <ul>
                        <li class="first scroll_btn"><a href="{{ action('NewsController@index') }}">News</a></li>
                        <li class="scroll_btn"><a href="{{ action('IdeaEntriesController@index') }}">Ideas</a></li>
                        <li class="scroll_btn"><a
                                    href="{{ action('MalfunctionEntriesController@index') }}">Malfunctions</a></li>
                        <li class="scroll_btn"><a href="{{ action('ReferendumsController@index') }}">Referendums</a>
                        </li>
                        <li class="scroll_btn"><a href="{{ action('ForumEntriesController@index') }}">Forum</a></li>
                        <li class="sub-menu">
                            <a href="javascript:void(0);">Hi, {{ auth()->user()->name }}</a>
                            <ul>
                                <li><a href="{{ action('UsersController@show', auth()->user()->id) }}">Profile</a></li>
                                @if(auth()->user()->isModerator())
                                    <li>
                                        <a href="{{ action('UsersController@moderatorSection') }}">Moderator section</a>
                                    </li>
                                @endif
                                <li><a href="{{ action('Auth\LoginController@logout') }}">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div><!-- //MENU -->
        </div><!-- //MENU BLOCK -->
    </div><!-- //CONTAINER -->
</header>