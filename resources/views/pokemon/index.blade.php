@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Pokemon List</h1>
        <a href="{{ route('pokemon.create') }}" class="btn btn-primary">Add Pokemon</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($pokemons as $pokemon)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ Storage::url($pokemon->photo) ?? 'https://placehold.co/200' }}"
class="img-thumbnail w-50">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pokemon->name }}</h5>
                        <p class="card-text">
                            <strong>ID:</strong> {{ Str::padLeft($pokemon->id, 4, '0') }}<br>
                            <strong>Species:</strong> {{ $pokemon->species }}<br>
                            <strong>Primary Type:</strong> {{ $pokemon->primary_type }}<br>
                            <strong>Power:</strong> {{ $pokemon->hp + $pokemon->attack + $pokemon->defense }}
                        </p>
                        <a href="{{ route('pokemon.show', $pokemon->id) }}" class="btn btn-info">View Details</a>
                        <a href="{{ route('pokemon.edit', $pokemon->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('pokemon.destroy', $pokemon->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $pokemons->links() }} <!-- Menampilkan link pagination -->
    </div>
</div>
@endsection
