@extends('layouts.app')
@section('title', 'Users | All')
@section('content')
    <h2>
        User Management
        @if(Auth::user()->can('addUser'))
            <a href="{{ route('users.create') }}" class="btn btn-success pull-right">Add User</a>
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
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created at</th>
                <th>User Roles</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1 ?>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('m-d-Y') }}</td>
                    <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                    <td>
                        @if(Auth::user()->can('editUser'))
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 2px;">Edit</a>
                        @endif
                        @if(Auth::user()->can('deleteUser'))
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
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