<form action = "" class="form-inline">
	<div class="form-group">
		<input type="text" id="search" name="search"
			   value="{{ request()->get('search', null) }}"
			   placeholder="Type your search here"
			   class="form-control"
		>
	</div>
	<button class="btn btn-primary" type="submit">Search</button>
</form>