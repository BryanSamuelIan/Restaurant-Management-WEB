@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role->name }}</td>    
                    <td>
                        <span class="active-status" data-user-id="{{ $user->id }}" data-active="{{ $user->is_active ? 'true' : 'false' }}">
                            {{ $user->is_active ? 'true' : 'false' }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    
</div>

@endsection
