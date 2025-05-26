<?php

namespace App\Http\Controllers;

use App\Models\ProgressPenelitian;
use App\Models\Penelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressPenelitianController extends Controller
{
    public function index(Request $request, $penelitianId)
    {
        // Ambil data penelitian
        $penelitian = \App\Models\Penelitian::findOrFail($penelitianId);

        // Pastikan user yang login adalah pemilik penelitian
        if ($penelitian->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $query = \App\Models\ProgressPenelitian::where('penelitian_id', $penelitianId);

        // Filter berdasarkan deskripsi progress, misalnya
        if ($request->filled('search')) {
            $query->where('description', 'LIKE', '%' . $request->input('search') . '%');
        }

        $progresses = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('progress.index', compact('progresses', 'penelitian'));
    }



    public function create($penelitianId)
    {
        $penelitian = Penelitian::findOrFail($penelitianId);
        // Pastikan user memiliki hak akses ke penelitian tersebut
        if ($penelitian->user_id !== Auth::id()) {
            abort(403);
        }
        return view('progress.create', compact('penelitian'));
    }

    public function store(Request $request, $penelitianId)
    {
        $penelitian = Penelitian::findOrFail($penelitianId);
        if ($penelitian->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'description'   => 'nullable|string',
            'file_progress' => 'required|file|max:2048',
        ]);

        $uploadedFile = $request->file('file_progress');
        $filename = time().'_'.$uploadedFile->getClientOriginalName();
        $path = $uploadedFile->storeAs('progress_uploads', $filename, 'public');
        $data['file_progress'] = $path;
        $data['penelitian_id'] = $penelitian->id;

        ProgressPenelitian::create($data);

        return redirect()->route('penelitian.show', $penelitian->id)
                         ->with('success', 'Progress berhasil ditambahkan.');
    }

    public function show($id)
    {
        $progress = ProgressPenelitian::findOrFail($id);
        // Pastikan user yang login adalah pemilik penelitian terkait progress tersebut
        if ($progress->penelitian->user_id !== Auth::id()) {
            abort(403);
        }
        return view('progress.show', compact('progress'));
    }

    public function edit($id)
    {
        $progress = \App\Models\ProgressPenelitian::findOrFail($id);
        // Pastikan user yang login adalah pemilik penelitian terkait progress tersebut
        if ($progress->penelitian->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }
        return view('progress.edit', compact('progress'));
    }

    public function update(Request $request, $id)
    {
        $progress = \App\Models\ProgressPenelitian::findOrFail($id);
        if ($progress->penelitian->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }
        
        $data = $request->validate([
            'description'   => 'nullable|string',
            'file_progress' => 'nullable|file|max:2048', // File opsional jika ingin diubah
        ]);

        // Jika ada file baru yang diupload, proses upload dan simpan path-nya
        if ($request->hasFile('file_progress')) {
            $uploadedFile = $request->file('file_progress');
            $filename = time().'_'.$uploadedFile->getClientOriginalName();
            $path = $uploadedFile->storeAs('progress_uploads', $filename, 'public');
            $data['file_progress'] = $path;
        }
        
        $progress->update($data);
        
        return redirect()->route('progress.index', $progress->penelitian_id)
                        ->with('success', 'Progress berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $progress = \App\Models\ProgressPenelitian::findOrFail($id);
        // Pastikan user yang login adalah pemilik penelitian terkait progress tersebut
        if ($progress->penelitian->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }
        $penelitianId = $progress->penelitian_id;
        $progress->delete();

        return redirect()->route('progress.index', $penelitianId)
                        ->with('success', 'Progress berhasil dihapus.');
    }

}
