@if(isToday($timestamp))
	{{ $timestamp->diffForHumans() }}
@else
	{{ $timestamp->format('d F Y | H:i') }}
@endif