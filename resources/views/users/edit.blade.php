@extends('layouts.app')

@section('content')
    {{ Form::open([action('UsersController@update',$user->id), 'files'=> true ,'method' => 'post', 'class' => 'form-horizontal']) }}
    <div class="col-md-2 col-sm-4 col-xs-12 text-center">
        <!--    Profile pic     -->
        <img class="img-circle img-responsive img-border" src="{{ asset('/images/users/'.$user->img_name) }}">
        <h3 class="golden"><strong>{{ $user->name }}</strong></h3>
        <div class="clearfix padbot20"></div>
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
    <div class="col-md-10 col-sm-8 col-xs-12">

        <!--    Email       -->
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {{ Form::label('email', 'Email:', ['class'=>'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
            </div>
            
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <!--  Description   -->
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            {{ Form::label('description', 'About me:', ['class'=>'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::textarea('description', $user->description, ['class' => 'form-control']) }}
            </div>
                
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <!--  Politics   -->
        <div class="form-group{{ $errors->has('politics') ? ' has-error' : '' }}">
            {{ Form::label('politics', 'Politics:', ['class'=>'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::textarea('politics', $user->politics, ['class' => 'form-control']) }}
            </div>
                
            @if ($errors->has('politics'))
                <span class="help-block">
                    <strong>{{ $errors->first('politics') }}</strong>
                </span>
            @endif
        </div>

        <!--  Interests   -->
        <div class="form-group{{ $errors->has('interests') ? ' has-error' : '' }}">
            {{ Form::label('interests', 'Interests:', ['class'=>'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::textarea('interests', $user->politics, ['class' => 'form-control']) }}
            </div>
                
            @if ($errors->has('interests'))
                <span class="help-block">
                    <strong>{{ $errors->first('interests') }}</strong>
                </span>
            @endif
        </div>
        
        <!--    Save button     -->
        {{ Form::submit('Save changes', ['class'=>'btn btn-link pull-right'])  }}
    </div>
    {{ Form::close() }}
@endsection