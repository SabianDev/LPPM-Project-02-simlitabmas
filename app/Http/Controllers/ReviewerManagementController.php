<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReviewerManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\User::role('reviewer')
            ->with('reviewerStatus');

        if ($request->filled('search') && $request->filled('filter')) {
            $search = $request->input('search');
            $filter = $request->input('filter');

            if ($filter === 'name') {
                $query->where('name', 'LIKE', "%{$search}%");
            } elseif ($filter === 'email') {
                $query->where('email', 'LIKE', "%{$search}%");
            } elseif ($filter === 'status') {
                $query->whereHas('reviewerStatus', function ($q) use ($search) {
                    $q->where('status', 'LIKE', "%{$search}%");
                });
            }
        }

        $reviewers = $query->orderBy('name')->paginate(5)->appends($request->all());

        return view('reviewer_management.index', compact('reviewers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reviewer = User::role('reviewer')
            ->with('reviewerStatus')
            ->findOrFail($id);
        return view('reviewer_management.show', compact('reviewer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reviewer = User::role('reviewer')
            ->with('reviewerStatus')
            ->findOrFail($id);
        return view('reviewer_management.edit', compact('reviewer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
        {
            $reviewer = User::role('reviewer')->findOrFail($id);

        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $reviewer->id,
            'status' => 'required|in:available,not_available',
        ]);

        // Update data reviewer (misalnya name, email, dll)
        $reviewer->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        // Cek apakah reviewerStatus sudah ada, jika tidak, buat data baru
        if (!$reviewer->reviewerStatus) {
            \App\Models\ReviewerStatus::create([
                'user_id' => $reviewer->id,
                'status'  => $data['status']
            ]);
        } else {
            $reviewer->reviewerStatus->update([
                'status' => $data['status']
            ]);
        }

        return redirect()->route('reviewer_management.index')
                        ->with('success', 'Reviewer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reviewer = User::role('reviewer')->findOrFail($id);
        $reviewer->delete();

        return redirect()->route('reviewer_management.index')
                         ->with('success', 'Reviewer berhasil dihapus.');
    }
}
