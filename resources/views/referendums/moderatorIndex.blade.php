@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col-xs-12 no-padding">
        @if ($referendums[0])
            <h2 class="generic-title text-center">Pending referendums</h2>
            @foreach($referendums as $referendum)
                <div class="col-xs-12 border-bottom">
                    <div class="col-xs-12">
                        <h2>{{ $referendum->title }}</h2>
                        <p class="text-muted">{{ $referendum->created_at->diffForHumans() }}</p>

                        <p class="ptext">{{ $referendum->description }}</p>
                    </div>
                    <a href="{{action('ReferendumsController@pendingShow', $referendum->id)}}"
                       class="btn btn-primary pull-right"><i class="fa fa-eye"></i> View referendum</a>
                </div>
            @endforeach

            <div class="row">
                <div class="text-center">
                    {{ $referendums->links() }}
                </div>
            </div>
        @else
            <h1 class="generic-title text-center"><i class="fa fa-coffee"></i> You are done for today!</h1>
        @endif
    </div>
@endsection