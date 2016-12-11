@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col-xs-12 no-padding">
        <h2 class="generic-title text-center">Malfunctions List</h2>
        <a href="{{action('MalfunctionEntriesController@create')}}" class="btn btn-primary"><i
                    class="fa fa-plus"></i> Report a malfunction</a>
	
		<div class="clearfix"></div>
		<div class="col-xs-12 text-right">
			@include('partials._searchable')
		</div>
		<hr>
        @foreach($malfunctions as $malfunction)
            <div class="col-xs-12 border-bottom">
                <div class="col-xs-12">
                    <h2>{{ $malfunction->title }}</h2>
                    <p class="text-muted">{{ $malfunction->created_at->diffForHumans() }}</p>
                    <h4 class="ptext"> Status: {{ $malfunction->status }}</h4>
                </div>

                <div class="col-xs-12">
                    <div class="pull-right">
                        @include('partials._voteUp', ['likeableType' => 'malfunction', 'likeable' => $malfunction])
                    </div>
                    <div class="pull-right">
                        <a href="{{action('MalfunctionEntriesController@show', $malfunction->id)}}"
                           class="btn btn-primary pull-right"><i class="fa fa-eye"></i> View details</a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="text-center">
                {{ $malfunctions->links() }}
            </div>
        </div>
    </div>
@endsection