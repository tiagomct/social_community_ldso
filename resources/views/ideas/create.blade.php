@extends('layouts.app')

@section('content')
    <div class = "container-fluid printing-content">
        <form action = "{{action('IdeaEntriesController@store')}}" method = "POST">
            {{csrf_field()}}
            <div class = "row">
                <div class = "col-xs-12 no-padding">
                    <h2 class = "generic-title text-center">Submit your idea</h2>
                </div>
            </div>

            <div class = "row">
                <div class = "col-xs-12 no-padding">
                    <!--     Title entry    -->
                    <div class = "form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <h3>Title:</h3>
                        <input type = "text" name = "title" value = "{{ old("title") }}" class = "form-control"
                               required autofocus>
                        @if ($errors->has('title'))
                            <span class = "help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class = "row">
                <div class = "col-xs-12 border-bottom no-padding">
                    <!--     Description entry   -->
                    <div class = "form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <h3>Description</h3>
                        <textarea name = "description" class = "form-control" required autofocus rows = "4">{{ old("description") }}</textarea>
                        @if ($errors->has('description'))
                            <span class = "help-block">
								<strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif

                    </div>
                </div>
            </div>

            <div class = "row">
                <div class = "col-xs-12">
                    <!--    Save button     -->
                    <input type = "submit" class = "btn btn-primary pull-right" value = "Submit your idea">
                </div>
            </div>
        </form>
    </div>
@endsection