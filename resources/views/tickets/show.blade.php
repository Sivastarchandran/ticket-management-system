@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $ticket->title }}</h1>
    <p>{{ $ticket->description }}</p>
    <p>Status: {{ $ticket->status }}</p>
    <a href="{{ route('tickets.index') }}" class="btn btn-primary">Back</a>
</div>
@endsection
