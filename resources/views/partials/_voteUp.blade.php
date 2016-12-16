<span>{{ $likeable->likes->count() . ' votes' }}</span>
@if(!$likeable->isMine())
    <a class="golden" href = "{{action('LikesController@toggleLike', [$likeableType, $likeable->id]) }}">
        @if(!$likeable->hasMyLike())
            <i class = "fa fa-arrow-up"></i> Vote up
        @else
            <i class = "fa fa-arrow-down"></i> Vote down
        @endif
    </a>
@endif