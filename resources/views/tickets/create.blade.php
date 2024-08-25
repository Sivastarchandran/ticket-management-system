@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Ticket</h1>
    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="open">Open</option>
                <option value="in_progress">In Progress</option>
                <option value="closed">Closed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
