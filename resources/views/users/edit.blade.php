@extends('layouts.app')
@section('title', 'Users | Update')
@section('content')
    <div class='col-lg-4 col-lg-offset-4'>
        <div class="well well bs-component">
            <legend>Update {{$user->name}}</legend>
            {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
            <div class="form-group @if ($errors->has('name')) has-error @endif">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, array('class' => 'form-control')) }}
                @if ($errors->has('name'))
                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>
            <div class="form-group @if ($errors->has('email')) has-error @endif">
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', null, array('class' => 'form-control')) }}
                @if ($errors->has('email'))
                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            <h5><b>Assign Role</b></h5>
            <div class="form-group @if ($errors->has('roles')) has-error @endif">
                @foreach ($roles as $role)
                    {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                    {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                @endforeach
            </div>
            <div class="form-group @if ($errors->has('password')) has-error @endif">
                {{ Form::label('password', 'Password') }}<br>
                {{ Form::password('password', array('class' => 'form-control')) }}
                @if ($errors->has('password'))
                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
            </div>
            <div class="form-group @if ($errors->has('password')) has-error @endif">
                {{ Form::label('password', 'Confirm Password') }}<br>
                {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
            </div>
            {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection