<?php
//kalau ada error di user() abaikan, itu tetep jalan

namespace App\Http\Controllers;

use App\Models\ReviewerAssignment;
use App\Models\User;
use App\Models\UserProposal; // atau gunakan model PengajuanPenelitian sesuai kebutuhan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewerTampungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ReviewerAssignment::where('reviewer_id', Auth::id())
            ->with('proposal');

        if ($request->filled('search') && $request->filled('filter')) {
            $search = $request->input('search');
            $filter = $request->input('filter');

            switch ($filter) {
                case 'proposal_id':
                    $query->where('proposal_id', $search);
                    break;

                case 'judul':
                    $query->whereHas('proposal', function ($q) use ($search) {
                        $q->where('judul_penelitian', 'LIKE', "%{$search}%");
                    });
                    break;

                case 'status':
                    $query->where('assignment_status', 'LIKE', "%{$search}%");
                    break;
            }
        }

        $assignments = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->all());

        return view('reviewer_tampung.index', compact('assignments'));
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
        $data = $request->validate([
            'proposal_id'      => 'required|exists:pengajuan_penelitian,id',
            'reviewer_user_id' => 'required|exists:users,id',
        ]);
    
        // Cek apakah proposal sudah pernah diassign sebelumnya
        $existingAssignment = ReviewerAssignment::where('proposal_id', $data['proposal_id'])->first();
        if ($existingAssignment) {
            return redirect()->back()->with('error', 'Proposal sudah di-assign sebelumnya.');
        }
    
        // Jika belum, buat record assignment baru
        ReviewerAssignment::create([
            'proposal_id'       => $data['proposal_id'],
            'reviewer_id'       => $data['reviewer_user_id'],
            'assignment_status' => 'assigned', // status awal, misalnya "assigned"
        ]);
    
        return redirect()->route('pengajuan_penelitian.show', $data['proposal_id'])
                         ->with('success', 'Proposal berhasil di-assign ke reviewer.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assignment = ReviewerAssignment::with('proposal')->findOrFail($id);

        // Pastikan reviewer yang login adalah pemilik assignment tersebut
        if ($assignment->reviewer_id !== Auth::id()) {
            abort(403);
        }

        return view('reviewer_tampung.show', compact('assignment'));
    }

    /**
     * Show form upload hasil review.
     */
    public function showReturnForm($assignmentId)
    {
        $assignment = ReviewerAssignment::with('proposal')->findOrFail($assignmentId);
        // Pastikan reviewer yang login adalah pemilik assignment
        if ($assignment->reviewer_id !== Auth::id()) {
            abort(403);
        }
        return view('reviewer_tampung.return', compact('assignment'));
    }

    /**
     * Process upload hasil review dan update proposal status.
     */
    public function storeReturn(Request $request)
    {
        $data = $request->validate([
            'assignment_id' => 'required|exists:reviewer_assignments,id',
            'review_file'   => 'required|file|max:2048', // misalnya max 2MB
            'review_status' => 'required|in:Approved,Not Approved',
            'komentar_review' => 'nullable|string',
        ]);

        $assignment = ReviewerAssignment::with('proposal')->findOrFail($data['assignment_id']);
        if ($assignment->reviewer_id !== Auth::id()) {
            abort(403);
        }

        // Upload file review
        $uploadedFile = $request->file('review_file');
        $originalName = $uploadedFile->getClientOriginalName();
        // Tambahkan timestamp untuk menghindari duplikasi
        $filename = time() . '_' . $originalName;
        $newFilePath = $uploadedFile->storeAs('proposal_uploads', $filename, 'public');

        // Update proposal record: ganti status dan file_proposal
        $proposal = $assignment->proposal;
        $proposal->update([
            'status' => $data['review_status'], // misalnya "Approved" atau "Not Approved"
            'file_proposal' => $newFilePath,
            'komentar_review' => $data['komentar_review'] ?? null,
        ]);

        // Update assignment status, misalnya menjadi "completed"
        $assignment->update([
            'assignment_status' => 'completed',
        ]);

        // Tambahkan kode notifikasi di sini
        $userPengaju = \App\Models\User::find($proposal->user_id);
        if ($userPengaju) {
            $userPengaju->notify(new \App\Notifications\ProposalReviewCompletedNotification($proposal, $data['review_status'], auth()->user()));
        }

        return redirect()->route('reviewer_tampung.show', $assignment->id)
                        ->with('success', 'Hasil review berhasil dikirim dan status proposal diperbarui.');
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
