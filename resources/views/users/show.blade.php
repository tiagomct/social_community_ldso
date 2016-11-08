@extends('layouts.app')

@section('css')
    <link rel = "stylesheet" href = "{{ elixir('css/userProfile.css') }}"/>
@endsection

@section('content')
    <div id="user-basic-info-container" class="col-xs-12 no-padding">
        <div class="col-md-3 col-sm-4 col-xs-12 user-profile-picture">
            <img class="img-rounded img-thumbnail img-circle" src="{{ asset('storage/users/'.$user->img_name) }}">
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
                    <a href="{{ action('ProfileController@edit', $user->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit Profile </a>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-xs-12 no-padding" id="user-activity-container">
        <h2 class="col-xs-12 text-center generic-title">Last Activity</h2>
        <div class="col-sm-6 col-xs-12 content-left content-left-top">
            <h5 class="head">News</h5>
            <a href="single.html">
                <div class="editor text-center">
                    <h3>DeltaMaker – The new kid on the block An Elegant 3D Printer</h3>
                    <p>A new cheap ass 3D Printer worth checking out</p>
                    <label>2 Days Ago</label>
                    <span></span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xs-12 content-left content-left-top">
            <h5 class="head">Forum</h5>
            <a href="single.html">
                <div class="editor text-center">
                    <h3>DeltaMaker – The new kid on the block An Elegant 3D Printer</h3>
                    <p>A new cheap ass 3D Printer worth checking out</p>
                    <label>2 Days Ago</label>
                    <span></span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xs-12 content-left content-left-top">
            <h5 class="head">Referendums</h5>
            <a href="single.html">
                <div class="editor text-center">
                    <h3>DeltaMaker – The new kid on the block An Elegant 3D Printer</h3>
                    <p>A new cheap ass 3D Printer worth checking out</p>
                    <label>2 Days Ago</label>
                    <span></span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xs-12 content-left content-left-top">
            <h5 class="head">Malfunctions</h5>
            <a href="single.html">
                <div class="editor text-center">
                    <h3>DeltaMaker – The new kid on the block An Elegant 3D Printer</h3>
                    <p>A new cheap ass 3D Printer worth checking out</p>
                    <label>2 Days Ago</label>
                    <span></span>
                </div>
            </a>
        </div>
    </div>
@endsection