@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tickets</h1>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Create Ticket</a>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No tickets found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
