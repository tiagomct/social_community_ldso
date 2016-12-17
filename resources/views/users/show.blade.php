@extends('layouts.app')

@section('css')
    <link rel = "stylesheet" href = "{{ elixir('css/userProfile.css') }}"/>
@endsection

@section('content')
    <div id="user-basic-info-container" class="col-xs-12 no-padding">
        <div class="col-md-3 col-sm-4 col-xs-12 user-profile-picture">
            @if($user->img_name == 'default.jpg')
                <img class="img-responsive img-thumbnail img-circle" src="{{ asset('/images/'.$user->img_name) }}">
            @else
                <img class="img-responsive img-thumbnail img-circle" src="{{ asset('/images/users/'.$user->img_name) }}">
            @endif
        </div>
    
        <div class="col-md-9 col-sm-8 col-xs-12 user-basic-info">
            <dl class="dl-horizontal col-xs-12 no-padding">
                <dt>Name</dt>
                <dd>{{ $user->name }}</dd>
            
                @if($user->id == auth()->user()->id)
                    <dt>Email</dt>
                    <dd>{{ $user->email }}</dd>
                @endif
            
                <dt>User since</dt>
                <dd>{{ $user->created_at->format('d F Y') }}</dd>
            
                <dt>About me</dt>
                <dd>{{ $user->description or '---' }}</dd>
            
                <dt>Political opinions</dt>
                <dd>{{ $user->politics or '---' }}</dd>
            
                <dt>Interests</dt>
                <dd>{{ $user->interests or '---' }}</dd>
            </dl>
    
            <div class="col-xs-12 no-padding text-right">
                @if($user->id==Auth::user()->id)
                    <a href="{{ action('UsersController@edit', $user->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit Profile </a>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-xs-12 no-padding" id="user-activity-container">
        <h2 class="col-xs-12 text-center generic-title">Last Activity</h2>
        @if(count($news) <= 0 && count($forumThreads) <= 0 && count($malfunctions) <= 0 && count($referendums) <= 0)
            <p class="text-center col-xs-12 text-muted">No recent activity</p>
        @endif
        
        @if(count($news) > 0)
            <div class="col-sm-6 col-xs-12 content-left content-left-top">
                <h5 class="head">News</h5>
                @foreach($news as $new)
                    <a href="#">
                        <div class="editor text-center">
                            <h3>{{ $new->title }}</h3>
                            <p>{{ substr($new->text, 0, 300).'...' }}</p>
                            <label>{{ $new->updated_at->diffForHumans() }}</label>
                            <span></span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
        
        @if(count($forumThreads) > 0)
            <div class="col-sm-6 col-xs-12 content-left content-left-top">
                <h5 class="head">Forum</h5>
                @foreach($forumThreads as $thread)
                    <a href="#">
                        <div class="editor text-center">
                            <h3>{{ $thread->title }}</h3>
                            <p>{{ substr($thread->description, 0, 300).'...' }}</p>
                            <label>{{ $thread->updated_at->diffForHumans() }}</label>
                            <span></span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
        
        @if(count($referendums) > 0)
            <div class="col-sm-6 col-xs-12 content-left content-left-top">
                <h5 class="head">Referendums</h5>
                @foreach($referendums as $referendum)
                    <a href="#">
                        <div class="editor text-center">
                            <h3>{{ $referendum->title }}</h3>
                            <p>{{ substr($referendum->description, 0, 300).'...' }}</p>
                            <label>{{ $referendum->updated_at->diffForHumans() }}</label>
                            <span></span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
        
        @if(count($malfunctions) > 0)
            <div class="col-sm-6 col-xs-12 content-left content-left-top">
                <h5 class="head">Malfunctions</h5>
                @foreach($malfunctions as $malfunction)
                    <a href="#">
                        <div class="editor text-center">
                            <h3>{{ $malfunction->title }}</h3>
                            <p>{{ substr($malfunction->description, 0, 300).'...' }}</p>
                            <label>{{ $malfunction->updated_at->diffForHumans() }}</label>
                            <span></span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection