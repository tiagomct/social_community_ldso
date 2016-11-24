<form class = "form-horizontal" role = "form" method = "POST"
	  action = "{{action('CommentsController@store', [$commentableType, $commentable->id])}}">
	{{ csrf_field() }}
	<div class = "form-group{{ $errors->has('description') ? ' has-error' : '' }}">
		<label for = "description" class = "col-md-4 control-label">Message</label>
		
		<div class = "col-md-6">
					<textarea id = "description" class = "form-control" name = "description"
							  required autofocus>{{ old('description', '') }}</textarea>
			@if ($errors->has('description'))
				<span class = "help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
			@endif
		</div>
	</div>
	
	<div class = "form-group">
		<div class = "col-md-6 col-md-offset-4">
			<input type = "submit" value = "Post"/>
		</div>
	</div>
</form>