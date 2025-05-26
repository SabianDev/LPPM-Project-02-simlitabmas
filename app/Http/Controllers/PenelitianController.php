<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use App\Models\PengajuanPenelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenelitianController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Penelitian::where('user_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->input('search');
            $filter = $request->input('filter');

            if ($filter == 'status') {
                $query->where('status', 'LIKE', "%{$search}%");
            } else {
                // Default ke judul jika filter tidak dipilih atau pilihannya "judul"
                $query->where('title', 'LIKE', "%{$search}%");
            }
        }

        $penelitians = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->all());

        return view('penelitian.index', compact('penelitians'));
    }



    public function create()
    {
        // Ambil proposal yang sudah di‑approve oleh user yang sedang login.
        $approvedProposals = PengajuanPenelitian::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->get();

        return view('penelitian.create', compact('approvedProposals'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'proposal_id'    => 'required|exists:pengajuan_penelitian,id',
            'title'          => 'required|string|max:255',
        ]);

        $data['user_id'] = Auth::id();
        $data['status']  = 'on progress'; // atau "On Progress"

        Penelitian::create($data);

        return redirect()->route('penelitian.index')
                         ->with('success', 'Penelitian baru berhasil dibuat.');
    }

    public function show($id)
    {
        $penelitian = Penelitian::with('progress', 'finalReport')->findOrFail($id);
        return view('penelitian.show', compact('penelitian'));
    }

    public function edit($id)
    {
        $penelitian = Penelitian::findOrFail($id);
        return view('penelitian.edit', compact('penelitian'));
    }

    public function update(Request $request, $id)
    {
        $penelitian = Penelitian::findOrFail($id);
        $data = $request->validate([
            'title'  => 'required|string|max:255',
            'status' => 'required|in:ongoing,finished',
        ]);
        $penelitian->update($data);
        return redirect()->route('penelitian.show', $penelitian->id)->with('success', 'Penelitian diperbarui.');
    }

    public function destroy($id)
    {
        $penelitian = Penelitian::findOrFail($id);
        $penelitian->delete();
        return redirect()->route('penelitian.index')->with('success', 'Penelitian dihapus.');
    }
}
