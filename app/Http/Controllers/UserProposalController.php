<?php

namespace App\Http\Controllers;

use App\Models\UserProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\UserProposal::where('user_id', Auth::id());

        if ($request->filled('search') && $request->filled('filter')) {
            $search = $request->input('search');
            $filter = $request->input('filter');

            switch ($filter) {
                case 'judul':
                    $query->where('judul_penelitian', 'LIKE', "%{$search}%");
                    break;
                case 'status':
                    $query->where('status', 'LIKE', "%{$search}%");
                    break;
                case 'tanggal':
                    $query->whereDate('created_at', $search);
                    break;
            }
        }

        $proposals = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->all());

        return view('status_pengajuan_proposal.index', compact('proposals'));
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
        // $proposal = UserProposal::findOrFail($id); // original
        
        $proposal = UserProposal::with(['anggota.user', 'anggotaMahasiswa'])->findOrFail($id);

        // Pastikan user yang sedang login adalah pemilik proposal tersebut.
        if ($proposal->user_id !== Auth::id()) {
            abort(403);
        }
        return view('status_pengajuan_proposal.show', compact('proposal'));
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
