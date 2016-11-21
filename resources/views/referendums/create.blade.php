@extends('layouts.app')

@section('content')
    <div class="container-fluid printing-content">
        <form action="{{action('ReferendumsController@store')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-xs-12 no-padding">
                    <h2 class="generic-title text-center">Create a referendum request</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 no-padding">
                    <!--     Title entry    -->
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <h3>Title:</h3>
                        <input type="text" name="title" value="{{ old("title") }}" class="form-control"
                               required autofocus>
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
                    <!--     Description entry   -->
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <h3>Description</h3>
                        <textarea name="description" class="form-control" required autofocus rows="4">
                            {{ old("description") }}
                            </textarea>
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
                    <!--        Answers list       -->
                    <h3>List of answers</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 no-padding">
                    <div class="form-group{{ $errors->has('answers[]') ? ' has-error' : '' }}">
                        <div id="answers-wrapper">
                            <input type="text" class="form-control" name="answers[]">
                            <input type="text" class="form-control" name="answers[]">
                        </div>
                        @if ($errors->has('answers[]'))
                            <span class="help-block">
                                <strong>{{ $errors->first('answers[]') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-primary pull-left" id="add-answer" type="button"><i class="fa fa-plus"></i>
                        Add answer
                    </button>
                    <!--    Save button     -->
                    <input type="submit" class="btn btn-primary pull-right" value="Submit request">
                </div>
            </div>
        </form>
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
                    var answer =
                            '<div id="answer-div">' +
                            '<div class="col-md-1"><button id="rm" type="button" class="btn btn-xs btn-danger pull-left"><i class="fa fa-remove"></i></button></div>' +
                            '<input type="text" class="form-control" name="answers[]" rows="2">' +
                            '</div>';
                    $(wrapper).append(answer);
                }
            });


            $(wrapper).on("click", "#rm", function (e) {
                e.preventDefault();
                $(this).closest("#answer-div").remove();
                x--;
            });

        });
    </script>
@endsection