@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Pokemon</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pokemon.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="species">Species</label>
            <input type="text" name="species" class="form-control" value="{{ old('species') }}">
        </div>
        <div class="form-group">
            <label for="primary_type">Primary Type</label>
            <select name="primary_type" class="form-control">
                @foreach($types as $type)
                    <option value="{{ $type }}" {{ old('primary_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" step="0.01" name="weight" class="form-control" value="{{ old('weight', 0) }}">
        </div>
        <div class="form-group">
            <label for="height">Height</label>
            <input type="number" step="0.01" name="height" class="form-control" value="{{ old('height', 0) }}">
        </div>
        <div class="form-group">
            <label for="hp">HP</label>
            <input type="number" name="hp" class="form-control" value="{{ old('hp', 0) }}">
        </div>
        <div class="form-group">
            <label for="attack">Attack</label>
            <input type="number" name="attack" class="form-control" value="{{ old('attack', 0) }}">
        </div>
        <div class="form-group">
            <label for="defense">Defense</label>
            <input type="number" name="defense" class="form-control" value="{{ old('defense', 0) }}">
        </div>
        <div class="form-group">
            <label for="is_legendary">Legendary</label>
            <input type="checkbox" name="is_legendary" value="1" {{ old('is_legendary') ? 'checked' : '' }}>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Pokemon</button>
    </form>
</div>
@endsection
