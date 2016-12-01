<div class = "leave">
	<h4>Leave a comment</h4>
</div>
<form id = "commentform" method = "POST" action = "{{ action('CommentsController@store', [$commentableType, $commentable->id]) }}">
	{{ csrf_field() }}
	<p class = "comment-form-comment">
		<label for = "description">Comment</label>
		<textarea id="description" name = "description" required autofocus></textarea>
	</p>
	<div class = "clearfix"></div>
	<p class = "form-submit">
		<input name = "submit" type = "submit" id = "submit" value = "Send">
	</p>
	<div class = "clearfix"></div>
</form>