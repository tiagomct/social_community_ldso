<h3><b>Leave a</b> Comment</h3>

<form id = "commentform" method = "POST" action = "{{ action('CommentsController@store', [$commentableType, $commentable->id]) }}">
	{{ csrf_field() }}
	<div class = "form-group">
		<div class="col-sm-8">
			<textarea id="description" name = "description" placeholder="Write your comment here" class="" required></textarea>
		</div>
	</div>
	
	<div class="clearfix"></div>
	<div class = "form-group">
		<div class="col-sm-12">
			<input name = "submit" class="btn btn-link" type = "submit" id = "submit" value = "Send">
		</div>
	</div>
</form>