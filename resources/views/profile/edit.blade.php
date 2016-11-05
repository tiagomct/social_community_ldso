@extends('layouts.app')

@section('content')

    <div class="row">
        {{ Form::open(['url'=>'/user/edit', 'files'=> true ,'method' => 'post']) }}
        <div class="col-md-3 col-md-offset-0 col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-0">
            <!--    Profile pic     -->
            <img class="img-rounded img-responsive" width="100%" height="100%"
                 src="/storage/uploads/users/{{ $user->img_name }}">
            <label class="btn btn-default btn-file">
                Change picture
                {{ Form::file('img', ['style'=>'display:none']) }}
            </label>
            @if ($errors->has('img'))
                <span class="help-block">
                    <strong>{{ $errors->first('img') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-9 col-xs-12 col-sm-8">
            <ul class="list-group">
                <!--   User name    -->
                <li class="list-group-item">
                    <h2>{{ $user->name }}</h2>
                </li>

                <!--    Email       -->
                <li class="list-group-item">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <h4>{{ Form::label('email', 'Email:', ['class'=>'control-label ']) }}</h4>
                        {{ Form::email('email', $user->email, ['class' => 'form-control']) }}

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </li>

                <!--  Description   -->
                <li class="list-group-item">
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <h4>{{ Form::label('description', 'About me:', ['class'=>'control-label']) }}</h4>
                        {{ Form::textarea('description', $user->description, ['class' => 'form-control']) }}

                        @if ($errors->has('description'))
                            <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                        @endif
                    </div>
                </li>

                <!--  Politics   -->
                <li class="list-group-item">

                    <div class="form-group{{ $errors->has('politics') ? ' has-error' : '' }}">
                        <h4>{{ Form::label('politics', 'Politics:', ['class'=>'control-label']) }}</h4>
                        {{ Form::textarea('politics', $user->politics, ['class' => 'form-control']) }}

                        @if ($errors->has('politics'))
                            <span class="help-block">
                        <strong>{{ $errors->first('politics') }}</strong>
                    </span>
                        @endif
                    </div>

                </li>

                <!--  Interests   -->
                <li class="list-group-item">

                    <div class="form-group{{ $errors->has('interests') ? ' has-error' : '' }}">
                        <h4>{{ Form::label('interests', 'Interests:', ['class'=>'control-label']) }}</h4>
                        {{ Form::textarea('interests', $user->politics, ['class' => 'form-control']) }}

                        @if ($errors->has('interests'))
                            <span class="help-block">
                        <strong>{{ $errors->first('interests') }}</strong>
                    </span>
                        @endif
                    </div>

                </li>
            </ul>
            <!--    Save button     -->
            {{ Form::submit('Save changes', ['class'=>'btn btn-default pull-right'])  }}
        </div>
    </div>
    {{ Form::close() }}

@endsection