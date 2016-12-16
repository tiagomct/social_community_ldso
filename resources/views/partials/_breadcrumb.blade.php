<section class="breadcrumbs_block clearfix parallax" @if(isset($bgImage))style="background-image: {{ $bgImage }}"@endif>
	<div class="container center">
		<h2><b>{{ $mainText }}</b></h2>
		<p>{{ $secondaryText or '' }}</p>
	</div>
</section>