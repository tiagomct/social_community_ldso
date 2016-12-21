@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div id="user-basic-info-container">
        <div class="col-md-2 col-sm-4 col-xs-12 user-profile-picture">
            @if($user->img_name == 'default.jpg')
                <img class="img-responsive img-circle img-border" src="{{ asset('/images/'.$user->img_name) }}">
            @else
                <img class="img-responsive img-circle img-border" src="{{ asset('/images/users/'.$user->img_name) }}">
            @endif
        </div>
    
        <div class="col-md-10 col-sm-8 col-xs-12 user-basic-info">
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
                    <a href="{{ action('UsersController@edit', $user->id) }}" class="btn btn-small-padding btn-link"><i class="fa fa-pencil"></i> Edit Profile </a>
                @endif
            </div>
        </div>
    </div>
    
    <div class="user-activity-container">
        <h2 class="col-xs-12 text-center generic-title"><strong>Last</strong> Activity</h2>
        @if(count($ideas) <= 0 && count($forumThreads) <= 0 && count($malfunctions) <= 0 && count($referendums) <= 0)
            <p class="text-center col-xs-12 text-muted">No recent activity</p>
        @else
            @if(count($forumThreads) > 0)
                <div class="clearfix"></div>
                <h4><strong class="golden">Forum Threads</strong></h4>
                @include('partials._latest_entries', ['entries' => $forumThreads])
            @endif
        
            @if(count($referendums) > 0)
                <div class="clearfix"></div>
                <h4><strong class="red">Referendums</strong></h4>
                @include('partials._latest_entries', ['entries' => $referendums])
            @endif
        
            @if(count($malfunctions) > 0)
                <div class="clearfix"></div>
                <h4><strong class="golden">Malfunctions</strong></h4>
                @include('partials._latest_entries', ['entries' => $malfunctions])
            @endif
        
            @if(count($ideas) > 0)
                <div class="clearfix"></div>
                <h4><strong class="red">Ideas</strong></h4>
                @include('partials._latest_entries', ['entries' => $ideas])
            @endif
        @endif
    </div>
@endsection