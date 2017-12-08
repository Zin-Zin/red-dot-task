@extends('layouts.app')
@section('title', 'Roles | Update')
@section('content')
    <div class='col-lg-4 col-lg-offset-4'>
        <div class="well well bs-component">
            <legend>Update Role: {{$role->name}}</legend>
            {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
            <div class="form-group">
                {{ Form::label('name', 'Role Name') }}
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>
            <h3>Assign Permissions</h3>
            @foreach ($permissions as $permission)
                {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                {{Form::label($permission->name, ucfirst($permission->name)) }}<br>
            @endforeach
            <br>
            {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection