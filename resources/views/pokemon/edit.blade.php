@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pokemon</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pokemon.update', $pokemon->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $pokemon->name) }}">
        </div>
        <div class="form-group">
            <label for="species">Species</label>
            <input type="text" name="species" class="form-control" value="{{ old('species', $pokemon->species) }}">
        </div>
        <div class="form-group">
            <label for="primary_type">Primary Type</label>
            <select name="primary_type" class="form-control">
                @foreach($types as $type)
                    <option value="{{ $type }}" {{ old('primary_type', $pokemon->primary_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" step="0.01" name="weight" class="form-control" value="{{ old('weight', $pokemon->weight) }}">
        </div>
        <div class="form-group">
            <label for="height">Height</label>
            <input type="number" step="0.01" name="height" class="form-control" value="{{ old('height', $pokemon->height) }}">
        </div>
        <div class="form-group">
            <label for="hp">HP</label>
            <input type="number" name="hp" class="form-control" value="{{ old('hp', $pokemon->hp) }}">
        </div>
        <div class="form-group">
            <label for="attack">Attack</label>
            <input type="number" name="attack" class="form-control" value="{{ old('attack', $pokemon->attack) }}">
        </div>
        <div class="form-group">
            <label for="defense">Defense</label>
            <input type="number" name="defense" class="form-control" value="{{ old('defense', $pokemon->defense) }}">
        </div>
        <div class="form-group">
            <label for="is_legendary">Legendary</label>
            <input type="checkbox" name="is_legendary" value="1" {{ old('is_legendary', $pokemon->is_legendary) ? 'checked' : '' }}>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Pokemon</button>
    </form>
</div>
@endsection
