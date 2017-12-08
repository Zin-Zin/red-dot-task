@extends('layouts.app')
@section('title', 'Roles | All')
@section('content')
    <h2>
        Roles Management
        @if(Auth::user()->can('addRole'))
            <a href="{{ URL::to('roles/create') }}" class="btn btn-success  pull-right">Add Role</a>
        @endif
    </h2>
    <hr>
    @if(session('status'))
        <p class="alert alert-success">{{ session('status') }}</p>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Role</th>
                <th>Permissions</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                    <td>
                        @if(Auth::user()->can('editRole'))
                            <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 2px;">Edit</a>
                        @endif
                        @if(Auth::user()->can('deleteRole'))
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @else -
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection