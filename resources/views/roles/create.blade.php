@extends('layouts.app')
@section('title', 'Role | New')
@section('content')
    <div class='col-lg-4 col-lg-offset-4'>
        <div class="well well bs-component">
            <legend>Create Role</legend>
            {{ Form::open(array('url' => 'roles')) }}
            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, array('class' => 'form-control')) }}
                @if ($errors->has('name'))
                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>
            <h5><b>Assign Permissions</b></h5>
            <div class='form-group'>
                @foreach ($permissions as $permission)
                    {{ Form::checkbox('permissions[]',  $permission->id ) }}
                    {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                @endforeach
            </div>
            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection