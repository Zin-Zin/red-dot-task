@extends('layouts.app')
@section('title', 'Permissions | Update')
@section('content')
    <div class='col-md-4 col-md-offset-4'>
        <h1><i class='fa fa-key'></i> Update {{$permission->name}}</h1>
        <br>
        {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}
        <div class="form-group @if ($errors->has('name')) has-error @endif">
            {{ Form::label('name', 'Permission Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
            @if ($errors->has('name'))
                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>
        <br>
        {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
@endsection