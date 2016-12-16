@extends('layouts.app')

@section('css')
@endsection

@section('above-navbar')
	@include('partials._breadcrumb', ['mainText' => 'Ideas'])
@endsection

@section('content')
	
	<div class="col-xs-12 text-right">
		@include('partials._searchable')
	</div>
	@include('partials._list_entries', ['entries' => $ideas])
	
	{{--
    <div class="col-xs-12 no-padding">
        <h2 class="generic-title text-center">Ideas List</h2>
        <a href="{{action('IdeaEntriesController@create')}}" class="btn btn-primary"><i
                    class="fa fa-plus"></i> Create new idea</a>
		
		<div class="clearfix"></div>
		<div class="col-xs-12 text-right">
			@include('partials._searchable')
		</div>
		<hr>
		
        @foreach($ideas as $idea)
            <div class="col-xs-12 border-bottom">
                <div class="col-xs-12">
                    <h2>{{ $idea->title }}</h2>
                    <p class="text-muted">{{ $idea->created_at->diffForHumans() }}</p>

                    <p class="ptext">{{ $idea->description }}</p>

                    <a href="{{action('IdeaEntriesController@show', $idea->id)}}" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> View idea </a>
                    <div class="pull-right">
                        @include('partials._voteUp', ['likeableType' => 'idea', 'likeable' => $idea])
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="text-center">
                {{ $ideas->links() }}
            </div>
        </div>
    </div>--}}
@endsection