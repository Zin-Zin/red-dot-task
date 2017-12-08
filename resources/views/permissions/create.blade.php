@extends('layouts.app')
@section('title', 'Permissions | New')
@section('content')
    <div class='col-lg-4 col-lg-offset-4'>
        <div class="well well bs-component">
            <legend>Create Permission</legend>
            {{ Form::open(array('url' => 'permissions')) }}
            <div class="form-group @if ($errors->has('name')) has-error @endif">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', '', array('class' => 'form-control')) }}
                @if ($errors->has('name'))
                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div><br>
            @if(!$roles->isEmpty())
                <h3>Assign Permission to Roles</h3>
                @foreach ($roles as $role)
                    {{ Form::checkbox('roles[]',  $role->id ) }}
                    {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                @endforeach
            @endif
            <br>
            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection