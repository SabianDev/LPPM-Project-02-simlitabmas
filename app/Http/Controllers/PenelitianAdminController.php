<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use App\Models\PengajuanPenelitian;
use Illuminate\Http\Request;

class PenelitianAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Penelitian::query();

        if ($request->filled('search') && $request->filled('filter')) {
            $search = $request->input('search');
            $filter = $request->input('filter');

            switch ($filter) {
                case 'title':
                    $query->where('title', 'LIKE', '%' . $search . '%');
                    break;
                case 'name':
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'LIKE', '%' . $search . '%');
                    });
                    break;
                case 'email':
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('email', 'LIKE', '%' . $search . '%');
                    });
                    break;
                case 'status':
                    $query->where('status', 'LIKE', '%' . $search . '%');
                    break;
                case 'created_at':
                    $query->whereDate('created_at', $search); // pastikan format input sesuai Y-m-d
                    break;
            }
        }

        $penelitians = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->all());

        return view('penelitian_admin.index', compact('penelitians'));
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
        $penelitian = Penelitian::with('progress', 'finalReport')->findOrFail($id);
        // Admin hanya melihat, jadi tidak perlu cek kepemilikan
        return view('penelitian_admin.show', compact('penelitian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
