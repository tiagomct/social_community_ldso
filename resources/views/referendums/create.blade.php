@extends('layouts.app')

@section('content')
	<h1 class="padbot80"><strong>Create</strong> a new <span class="golden">Referendum</span></h1>
	
	<form action = "{{action('ReferendumsController@store')}}" method = "POST" class="form-horizontal">
		{{csrf_field()}}
		<div class = "form-group{{ $errors->has('title') ? ' has-error' : '' }}">
			<label for = "title" class = "control-label col-sm-2">Title</label>
			<div class="col-sm-10">
				<input type = "text" id="title" name = "title" value = "{{ old("title") }}" class = "form-control" required autofocus >
				@if ($errors->has('title'))
					<span class = "help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
				@endif
			</div>
		</div>
		<div class = "form-group{{ $errors->has('description') ? ' has-error' : '' }} padbot20">
			<label for = "description" class="control-label col-sm-2">Description</label>
			<div class="col-sm-10">
				<textarea id="description" name = "description" class = "form-control" required autofocus rows = "4">{{ old("description") }}</textarea>
				@if ($errors->has('description'))
					<span class = "help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
				@endif
			</div>
		</div>
		
		<div class="form-group">
			<h3 class="text-center">List of Answers</h3>
			
			<div class = "form-group{{ $errors->has('answers[]') ? ' has-error' : '' }} col-xs-12">
				<div class="col-sm-10 col-sm-offset-2">
					<div id = "answers-wrapper" class="padbot10">
						<input type = "text" placeholder="Type a possible answer" class = "form-control" name = "answers[]">
						<input type = "text" placeholder="Type a possible answer" class = "form-control" name = "answers[]">
					</div>
					<div>
						<button class = "btn btn-link pull-left" id = "add-answer" type = "button">
							<i class = "fa fa-plus"></i> Add answer
						</button>
					</div>
					@if ($errors->has('answers[]'))
						<span class = "help-block">
							<strong>{{ $errors->first('answers[]') }}</strong>
						</span>
					@endif
				</div>
			</div>
		</div>
		
		<div class = "form-group">
			<div class="col-sm-12">
				<input type = "submit" class = "btn btn-link pull-right" value = "Submit Referendum Request">
			</div>
		</div>
	</form>
@endsection

@section('js')
	<script type = "text/javascript">
		$(document).ready(function () {
			var max_fields = 10;
			var wrapper = $("#answers-wrapper");
			var add_button = $("#add-answer");
			
			add_button.on('click', function () {
				var current_answers = wrapper.children('input');
				
				if(current_answers.length <= max_fields) {
				    wrapper.append('<div class="input-group answer-container" style="margin-bottom: 10px">' +
                        	'<input type = "text" placeholder="Type a possible answer" class = "form-control" name = "answers[]">' +
							'<span class="input-group-btn">' +
							'<button class="btn btn-danger rm-answer" type="button" style="color: #fff" onclick="$(this).parent().parent().remove()">Remove</button>' +
							'</span></div>');
				}
            });
			
		});
	</script>
@endsection