@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class="col-xs-12 printing-content">
        <div class="print-main">
            <h3>Referendum</h3>
            <a>{{ $referendum->title }}</a>
            <p class="sub_head">Started on {{ $referendum->created_at->format('jS F \of Y') }}</p>
            <p class="ptext">{{ $referendum->description }}</p>

            @include('poll._poll', ['pollableId' => $referendum->id, 'poll' => $poll, 'pollableType' => 'referendum'])


        </div>
        <div class="print-grids">
            <div class="print-grid">
                <ul class="list-group">
                    @foreach($comments as $comment)
                        <li class="list-group-item">
                            <h4 class="list-group-item-heading">
                                {{ $comment->author->name }}
                            </h4>
                            <span class="sub_head">
								@if($comment->created_at->isToday() )
                                    {{ $comment->created_at->diffForHumans() }}
                                @else
                                    {{ $comment->created_at->format('jS F \of Y \a\t H:i') }}
                                @endif
							</span>
                            @include('likes._thumbs', ['likeableType' => 'comment', 'likeable' => $comment])
                            <p class="list-group-item-text">
                                {{ $comment->description }}
                            </p>
                        </li>
                    @endforeach
                </ul>
                <div class="row">
                    <div class="text-center">
                        {{ $comments->links() }}
                    </div>
                </div>
                <div class="row">
                    @include('comments._create', ['commentableType' => 'referendum', 'commentable' => $referendum])
                </div>
            </div>
        </div>
    </div>
@endsection