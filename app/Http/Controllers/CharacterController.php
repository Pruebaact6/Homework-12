<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Movie;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::with('movie')->paginate(9);
        return view('characters.index', compact('characters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();
        return view('characters.create', compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'movie_id' => 'required|exists:movies,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $character = new Character($request->except('image'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('characters', 'public');
            $character->image_path = $path;
        }

        $character->save();

        return redirect()->route('characters.index')->with('success', 'Personaje creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        return view('characters.show', compact('character'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        $movies = Movie::all();
        return view('characters.edit', compact('character', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'movie_id' => 'required|exists:movies,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $character->fill($request->except('image'));

        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($character->image_path) {
                \Storage::disk('public')->delete($character->image_path);
            }
            $path = $request->file('image')->store('characters', 'public');
            $character->image_path = $path;
        }

        $character->save();

        return redirect()->route('characters.index')->with('success', 'Personaje actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        if ($character->image_path) {
            \Storage::disk('public')->delete($character->image_path);
        }
        $character->delete();
        return redirect()->route('characters.index')->with('success', 'Personaje eliminado exitosamente.');
    }
}
