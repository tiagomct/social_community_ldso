@extends('layouts.app')

@section('content')
    <h1 class="padbot80"><strong>Share</strong> your <span class="golden">Idea</span></h1>
    
    <form action = "{{action('IdeaEntriesController@store')}}" method = "POST" class="form-horizontal">
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
        <div class = "form-group{{ $errors->has('description') ? ' has-error' : '' }}">
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

        <div class = "form-group">
            <div class="col-sm-12">
                <input type = "submit" class = "btn btn-link pull-right" value = "Submit your idea">
            </div>
        </div>
    </form>
@endsection