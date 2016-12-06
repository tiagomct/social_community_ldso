@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/referendumShow.css') }}"/>
@endsection

@section('content')
    <div class="col-xs-12 printing-content">
        <div class="print-main">
            <h3>{{ $malfunctionEntry->title }}</h3>
            <form action="{{ action('MalfunctionEntriesController@update', $malfunctionEntry->id) }}"
                  method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <input class="btn btn-primary pull-right" type="submit" value="Save changes">
                </div>
                <div class="row">
                    <div>
                        <a>Submitted by: </a>
                        <p class="ptext">{{ $malfunctionEntry->author->name }}</p>
                    </div>
                    <div>
                        <a>Submitted on:</a>
                        <p class="ptext"> {{ $malfunctionEntry->created_at->format('jS F \of Y') }}</p>
                    </div>
                    <div>
                        <a>Description: </a>
                        <p class="ptext">{{ $malfunctionEntry->description }}</p>
                    </div>
                    <div class="form-group">
                        <label for="status"><a>Status:</a></label>
                        <select class="form-control" id="status" name="status">
                            <option
                                    @if($malfunctionEntry->status == "pending")
                                    selected="selected"
                                    @endif
                                    value="pending">
                                Pending
                            </option>
                            <option
                                    @if($malfunctionEntry->status == "in progress")
                                    selected="selected"
                                    @endif
                                    value="in progress">
                                In progress
                            </option>
                            <option
                                    @if($malfunctionEntry->status == "fixed")
                                    selected="selected"
                                    @endif
                                    value="fixed">
                                Fixed
                            </option>
                        </select>
                    </div>
                    <div class="form-group{{ $errors->has('report') ? ' has-error' : '' }}">
                        <label for="report"><a>Description</a></label>
                        <textarea name="report" class="form-control" required autofocus
                                  rows="6">{{ $malfunctionEntry->report }}</textarea>
                        @if ($errors->has('report'))
                            <span class="help-block">
								<strong>{{ $errors->first('report') }}</strong>
                            </span>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection