<form action = "" method="post" class="form-inline search-form">
	{{ csrf_field() }}
	<div class="form-group">
		<div class="input-group">
			<input type="text" name="search" class="form-control" value="{{ request()->get('search', null) }}" placeholder="Search for...">
			<span class="input-group-btn">
				<button class="btn" type="submit"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</div>
</form>