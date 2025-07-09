<?php

namespace App\Http\Controllers;

use App\Models\LARA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LARAController extends Controller
{
    /**
     * Display a listing of the user's digital wills.
     */
    public function index()
    {
        $laras = LARA::where('pemilik_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('laras.index', compact('laras'));
    }

    /**
     * Show the form for creating a new digital will.
     */
    public function create()
    {
        return view('laras.create');
    }

    /**
     * Store a newly created digital will in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'penerima_id' => 'required|exists:users,id',
        ]);

        LARA::create([
            'title' => $request->title,
            'content' => $request->content,
            'pemilik_id' => Auth::id(),
            'penerima_id' => $request->penerima_id,
            'is_released' => false,
        ]);

        return redirect()->route('laras.index')->with('success', 'Digital will created successfully.');
    }

    /**
     * Display the specified digital will.
     */
    public function show(LARA $lara)
    {
        $this->authorize('view', $lara);
        return view('laras.show', compact('lara'));
    }

    /**
     * Show the form for editing the specified digital will.
     */
    public function edit(LARA $lara)
    {
        $this->authorize('update', $lara);
        return view('laras.edit', compact('lara'));
    }

    /**
     * Update the specified digital will in storage.
     */
    public function update(Request $request, LARA $lara)
    {
        $this->authorize('update', $lara);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'penerima_id' => 'required|exists:users,id',
        ]);

        $lara->update([
            'title' => $request->title,
            'content' => $request->content,
            'penerima_id' => $request->penerima_id,
        ]);

        return redirect()->route('laras.index')->with('success', 'Digital will updated successfully.');
    }

    /**
     * Remove the specified digital will from storage.
     */
    public function destroy(LARA $lara)
    {
        $this->authorize('delete', $lara);

        $lara->delete();

        return redirect()->route('laras.index')->with('success', 'Digital will deleted successfully.');
    }
}
