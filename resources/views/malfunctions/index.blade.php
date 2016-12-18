@extends('layouts.app')

@section('css')
@endsection

@section('above-navbar')
    @include('partials._breadcrumb', ['mainText' => 'Malfunctions'])
@endsection

@section('content')
    <div class="col-xs-12 text-right top-actions-container">
        <a href="{{action('MalfunctionEntriesController@create')}}" class="btn btn-small-padding btn-create">
            <i class="fa fa-plus"></i> Report New Malfunction
        </a>
        @include('partials._searchable')
    </div>
    @include('partials._list_entries', ['entries' => $malfunctions, 'likesText' => 'Votes'])
@endsection