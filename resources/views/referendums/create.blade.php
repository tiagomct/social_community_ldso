@extends('layouts.app')

@section('content')
    <div class="container-fluid printing-content">
        <div class="row">
            <div class="col-xs-12 no-padding">
                <h2 class="generic-title text-center">Create a referendum request</h2>
                {{ Form::open([action('ReferendumsController@create'), 'class'=>'form-horizontal']) }}
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 no-padding">
                <!-- Title entry-->
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <h3>Title:</h3>
                    {{ Form::text('title', old('title'), ['class' => 'form-control', 'required' , 'autofocus'] ) }}

                    @if ($errors->has('title'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 border-bottom no-padding">
                <!-- Description entry -->
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <h3>Description</h3>
                    {{ Form::textarea('description', old('description'), ['class' => 'form-control smaller-textarea', 'required' , 'autofocus'] ) }}

                    @if ($errors->has('description'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                            </span>
                    @endif

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 no-padding">
                <!-- Answers list -->
                <h3>List of answers</h3>
            </div>
        </div>
        <div id="answers-wrapper">
            <div class="row">
                <div class="col-md-12 no-padding">
                    <div class="form-group{{ $errors->has('answers[]') ? ' has-error' : '' }}">
                        <h4>Answer</h4>
                        {{ Form::textarea('answers[]', old('answers[]'), ['class' => 'form-control smaller-textarea', 'required']) }}
                        @if ($errors->has('answers[]'))
                            <span class="help-block">
                                <strong>{{ $errors->first('answers[]') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button class="btn btn-primary pull-left" id="add-answer"><i class="fa fa-plus"></i> Add answer</button>
                <!--    Save button     -->
                {{ Form::submit('Submit request', ['class'=>'btn btn-primary pull-right'])  }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var max_fields = 10;
            var wrapper = $("#answers-wrapper");
            var add_button = $("#add-answer");


            var x = 1;
            $(add_button).click(function (e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;
                    var answer = '<div class="row" id="answer-div">' +
                            '<div class="col-md-12 no-padding">' +
                            '<div class="form-group">' +
                            '<div class="col-md-10"><h4>Answer</h4></div>' +
                            '<div class="col-md-2"><button id="rm" type="button" class="btn btn-xs btn-danger pull-right"><i class="fa fa-remove"></i></button></div>' +
                            '<textarea class="form-control smaller-textarea" name="answers[]" cols="50" rows="10" id="answers[]"></textarea>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    $(wrapper).append(answer);
                }
            })


            $(wrapper).on("click", "#rm", function (e) {
                e.preventDefault();
                $(this).closest("#answer-div").remove();
                x--;
            })

        });
    </script>
@endsection