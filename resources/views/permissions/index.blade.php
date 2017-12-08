@extends('layouts.app')
@section('title', 'Permissions | All')
@section('content')
    <h2>Permissions Management
        @if(Auth::user()->can('addPermission'))
            <a href="{{ URL::to('permissions/create') }}" class="btn btn-success pull-right">Add Permission</a>
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
                <th>Permissions</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>
                        @if(Auth::user()->can('editPermission'))
                            <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 2px;">Edit</a>
                        @endif
                        @if(Auth::user()->can('deletePermission'))
                            {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
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