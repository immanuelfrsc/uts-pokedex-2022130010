<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\support\facades\Storage;
use App\Models\Pokemon;


class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $pokemons = Pokemon::paginate(20);
    return view('pokemon.index', compact('pokemons'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = [
            'Grass', 'Fire', 'Water', 'Bug', 'Normal', 'Poison',
            'Electric', 'Ground', 'Fairy', 'Fighting', 'Psychic',
            'Rock', 'Ghost', 'Ice', 'Dragon', 'Dark', 'Steel', 'Flying'
        ];
        return view('pokemon.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'weight' => 'nullable|numeric|max:999999.99',
            'height' => 'nullable|numeric|max:999999.99',
            'hp' => 'required|integer|max:9999',
            'attack' => 'required|integer|max:9999',
            'defense' => 'required|integer|max:9999',
            'is_legendary' => 'nullable|boolean', // Mengubah validasi menjadi nullable
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        $pokemon = new Pokemon();
        $pokemon->name = $request->name;
        $pokemon->species = $request->species;
        $pokemon->primary_type = $request->primary_type;
        $pokemon->weight = $request->weight;
        $pokemon->height = $request->height;
        $pokemon->hp = $request->hp;
        $pokemon->attack = $request->attack;
        $pokemon->defense = $request->defense;

        // Memeriksa apakah checkbox is_legendary dicentang
        $pokemon->is_legendary = $request->has('is_legendary');

        // Mengupload foto jika ada
        if ($request->hasFile('photo')) {
            $pokemon->photo = $request->file('photo')->store('photos', 'public');
        }

        $pokemon->save();

        return redirect()->route('pokemon.index')->with('success', 'Pokemon added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        return view('pokemon.show', compact('pokemon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $types = [
            'Grass', 'Fire', 'Water', 'Bug', 'Normal', 'Poison',
            'Electric', 'Ground', 'Fairy', 'Fighting', 'Psychic',
            'Rock', 'Ghost', 'Ice', 'Dragon', 'Dark', 'Steel', 'Flying'
        ];
        return view('pokemon.edit', compact('pokemon', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'weight' => 'nullable|numeric|max:999999.99',
            'height' => 'nullable|numeric|max:999999.99',
            'hp' => 'nullable|integer|max:9999',
            'attack' => 'nullable|integer|max:9999',
            'defense' => 'nullable|integer|max:9999',
            'is_legendary' => 'nullable|boolean', // Mengubah validasi menjadi nullable
            'photo' => 'nullable|image|max:2048|mimes:jpeg,jpg,png,gif,svg',
        ]);

        $pokemon = Pokemon::findOrFail($id);
        $pokemon->update($validated);

        // Mengupload foto baru jika ada
        if ($request->hasFile('photo')) {
            // Menghapus foto lama jika perlu
            if ($pokemon->photo) {
                Storage::delete('public/' . $pokemon->photo);
            }
            $pokemon->photo = $request->file('photo')->store('photos', 'public');
        }

        return redirect()->route('pokemon.index')->with('success', 'Pokemon berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        // Menghapus foto jika ada
        if ($pokemon->photo) {
            Storage::delete('public/' . $pokemon->photo);
        }
        $pokemon->delete();
        return redirect()->route('pokemon.index')->with('success', 'Pokemon berhasil dihapus');
    }

}
