<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programStudi = ProgramStudi::all();
        return view('program_studi.index', compact('programStudi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program_studi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'namaProdi' => 'required|string|max:255',
        ]);

        ProgramStudi::create($validated);

        return redirect()->route('program_studi.index')
                         ->with('success', 'Program Studi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        return view('program_studi.show', compact('programStudi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        return view('program_studi.edit', compact('programStudi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'namaProdi' => 'required|string|max:255',
        ]);

        $programStudi = ProgramStudi::findOrFail($id);
        $programStudi->update($validated);

        return redirect()->route('program_studi.index')
                         ->with('success', 'Program Studi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        $programStudi->delete();

        return redirect()->route('program_studi.index')
                         ->with('success', 'Program Studi berhasil dihapus.');
    }
}
