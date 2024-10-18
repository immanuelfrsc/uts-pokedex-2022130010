@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $pokemon->name }} - Details</h1>

    <div class="card">
        <div class="card-body">
            <img src="{{ Storage::url($pokemon->photo) ?? 'https://placehold.co/200' }}"
            class="img-thumbnail w-50">
            <h5 class="card-title">{{ $pokemon->name }}</h5>
            <p class="card-text">
                <strong>Species:</strong> {{ $pokemon->species }}<br>
                <strong>Type:</strong> {{ $pokemon->primary_type }}<br>
                <strong>Weight:</strong> {{ $pokemon->weight }}<br>
                <strong>Height:</strong> {{ $pokemon->height }}<br>
                <strong>HP:</strong> {{ $pokemon->hp }}<br>
                <strong>Attack:</strong> {{ $pokemon->attack }}<br>
                <strong>Defense:</strong> {{ $pokemon->defense }}<br>
                <strong>Legendary:</strong> {{ $pokemon->is_legendary ? 'Yes' : 'No' }}
            </p>
            <a href="{{ route('pokemon.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
