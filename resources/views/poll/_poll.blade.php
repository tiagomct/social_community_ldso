<div class="poll">
    @foreach($poll['answers'] as $answer)
        <div class="chart-bar">
            <div class="col-sm-5 col-xs-12 text-left">
                <span>{{ $answer->description }}</span>
            </div>
            <div class="col-sm-5 col-xs-12 text-center">
                <div class="progress">
                    <div class="progress-bar {{ $answer->hasMyVote() ? 'progress-bar-red' : 'progress-bar-dark-blue' }}"
                         role="progressbar"
                         aria-valuenow="{{ $answer->votes->count() }}"
                         aria-valuemin="0"
                         aria-valuemax="{{ $poll['totalVotes'] }}"
                         style="width: {{ $poll['totalVotes']  == 0 ? 0 : round($answer->votes->count()*100/$poll['totalVotes'] , 2) }}%;"
                         data-toggle="tooltip" data-placement="top"
                         title="{{ $answer->votes->count().' of '.$poll['totalVotes']  }}">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-xs-12 text-right">
                @if(!$poll['userAnswerId'])
                    <a href="{{action('PollsController@submitVote', [$pollableType , $pollableId, $answer->id] ) }}"
                       class="btn btn-info btn-xs">
                        <i class="fa fa-thumbs-up"></i> Vote
                    </a>
                @else
                    @if($answer->id == $poll['userAnswerId'])
                        <span class="label bg-red" disabled="disabled">My vote</span>
                    @endif
                @endif
                <span>{{ $answer->votes->count() . ' votes' }}</span>
            </div>
            <div class="clearfix"></div>
        </div>
    @endforeach
</div>