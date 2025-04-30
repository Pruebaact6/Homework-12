<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::latest()->paginate(9);
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'classification' => 'required|string|max:255',
            'release_date' => 'required|date',
            'review' => 'required|string',
            'season' => 'nullable|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        $movie = new Movie($validated);
        $movie->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('movies', 'public');
            $movie->image_path = $path;
        }

        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Película creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'classification' => 'required|string|max:255',
            'release_date' => 'required|date',
            'review' => 'required|string',
            'season' => 'nullable|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($movie->image_path) {
                Storage::disk('public')->delete($movie->image_path);
            }
            $path = $request->file('image')->store('movies', 'public');
            $validated['image_path'] = $path;
        }

        $movie->update($validated);

        return redirect()->route('movies.index')->with('success', 'Película actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        if ($movie->image_path) {
            Storage::disk('public')->delete($movie->image_path);
        }
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Película eliminada exitosamente.');
    }

    public function filter($type)
    {
        $query = Movie::query();

        switch ($type) {
            case 'recientes':
                $query->where('release_date', '>=', now()->subMonths(6));
                break;
            case 'proximos':
                $query->where('release_date', '>', now());
                break;
            case 'anteriores':
                $query->where('release_date', '<', now()->subMonths(6));
                break;
        }

        $movies = $query->latest()->paginate(9);
        return view('movies.index', compact('movies'));
    }
}
