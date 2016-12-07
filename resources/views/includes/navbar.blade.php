<div class="header">
    <div class="container">
        <div class="logo">
            <a href="{{ url('/') }}"><h1>{{ config('app.name') }}</h1></a>
        </div>
        <div class="pages">
            <ul>
                <li><a href="{{ action('NewsEntriesController@index') }}">News</a></li>
                <li><a href="{{ action('ForumEntriesController@index') }}">Forum</a></li>
                <li><a href="{{ action('ReferendumsController@index') }}">Referendums</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Malfunctions <span class="caret"></span></a>
                    <ul class="dropdown-menu list-group">
                        <li class="list-group-item">
                            <a href="{{ action('MalfunctionEntriesController@index') }}">All</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ action('MalfunctionEntriesController@index', ['status' => 'pending']) }}">Pending</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ action('MalfunctionEntriesController@index', ['status' => 'in progress']) }}">In
                                progress</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ action('MalfunctionEntriesController@index', ['status' => 'fixed']) }}">Fixed</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="navigation">
            <ul>
                <li><a href="{{ action('UsersController@show', auth()->user()->id) }}"><i
                                class="fa fa-user"></i> {{ auth()->user()->name }}</a></li>
                <li><a href="{{ action('Auth\LoginController@logout') }}"><i class="fa fa-lock"></i> Logout</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>