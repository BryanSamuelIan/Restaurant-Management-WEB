@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Banner</th>
                    <th>Is active?</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>
                            <img src="{{ asset( $event->banner) }}" alt="Event Banner" width="100" height="100">
                        </td>
                        <td>{{ $event->is_active === 1 ? 'Yes' : 'No' }}</td>
                        @if (Auth::user()->isOwner())
                            <td>
                                <a href="{{ route('owner.event.edit', ['id' => $event->id]) }}"
                                    class="btn btn-primary">Edit</a>

                                    <form action="{{ route('owner.event.destroy', $event->id) }}" method="post"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                            </td>
                        @else(Auth::user()->isAdmin())
                            <td>
                                <a href="{{ route('admin.event.edit', ['id' => $event->id]) }}"
                                    class="btn btn-primary">Edit</a>



                                    <form action="{{ route('admin.event.destroy', $event->id) }}" method="post"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>

                            </td>
                        @endif


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
