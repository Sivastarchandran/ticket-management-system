@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Ticket</h1>
    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $ticket->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $ticket->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="open" @if($ticket->status == 'open') selected @endif>Open</option>
                <option value="in_progress" @if($ticket->status == 'in_progress') selected @endif>In Progress</option>
                <option value="closed" @if($ticket->status == 'closed') selected @endif>Closed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
