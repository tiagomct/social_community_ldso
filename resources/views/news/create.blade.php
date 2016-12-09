@extends('layouts.app')

@section('content')
    <div class = "container-fluid printing-content">
        <form action = "{{action('NewsEntriesController@store')}}" method = "POST">
            {{csrf_field()}}
            <div class = "row">
                <div class = "col-xs-12 no-padding">
                    <h2 class = "generic-title text-center">Report news story</h2>
                </div>
            </div>

            <div class = "row">
                <div class = "col-xs-8 pull-left no-padding">
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
                <div class = "col-xs-3 pull-right no-padding">
                    <!--     Category entry    -->
                    <div class = "form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                        <h3>Category:</h3>
                        <select class="form-control" id="category">
                            <option>Politics</option>
                            <option>Economics</option>
                            <option>Justice</option>
                            <option>Sports</option>
                            <option>Science</option>
                            <option>Education</option>
                            <option>Technology</option>
                            <option>Entertainment</option>
                            <option>Other</option>
                        </select>
                        @if ($errors->has('category'))
                            <span class = "help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
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
                    <input type = "submit" class = "btn btn-primary pull-right" value = "Report news story">
                </div>
            </div>
        </form>
    </div>
@endsection