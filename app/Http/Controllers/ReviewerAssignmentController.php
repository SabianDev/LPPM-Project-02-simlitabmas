<?php

namespace App\Http\Controllers;

use App\Models\ReviewerStatus;
use App\Models\User;
use App\Models\UserProposal;
use Illuminate\Http\Request;

class ReviewerAssignmentController extends Controller
{
    /**
     * Menampilkan halaman untuk memilih reviewer yang available.
     */
    public function create($proposalId)
    {
        // Cek apakah proposal sudah pernah diassign
        $existingAssignment = \App\Models\ReviewerAssignment::where('proposal_id', $proposalId)->first();
        if ($existingAssignment) {
            return redirect()->route('pengajuan_penelitian.show', $proposalId)
                ->with('error', 'Proposal sudah diassign sebelumnya.');
        }
        // Ambil semua reviewer yang statusnya available
        $reviewers = ReviewerStatus::where('status', 'available')
            ->with('user') // mengambil data user terkait
            ->get();

        // Kirim proposalId untuk assignment nanti
        return view('reviewer_assignment.create', compact('reviewers', 'proposalId'));
    }

    /**
     * Menyimpan assignment reviewer untuk proposal tertentu.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'proposal_id'      => 'required|exists:pengajuan_penelitian,id',
            'reviewer_user_id' => 'required|exists:users,id',
        ]);
    
        // Cek ulang jika assignment sudah ada
        $existing = \App\Models\ReviewerAssignment::where('proposal_id', $data['proposal_id'])->first();
        if ($existing) {
            return redirect()->route('pengajuan_penelitian.show', $data['proposal_id'])
                ->with('error', 'Proposal sudah diassign sebelumnya.');
        }
    
        // Simpan assignment: update status reviewer menjadi "on_work" dan simpan record di reviewer_assignments
        $assignment = \App\Models\ReviewerAssignment::create([
            'proposal_id'       => $data['proposal_id'],
            'reviewer_id'       => $data['reviewer_user_id'],
            'assignment_status' => 'assigned', // misalnya status awalnya "assigned"
        ]);
    
        // // Update status reviewer di tabel reviewer_status
        // $reviewerStatus = \App\Models\ReviewerStatus::where('user_id', $data['reviewer_user_id'])->first();
        // if ($reviewerStatus) {
        //     $reviewerStatus->update(['status' => 'on_work']);
        // }
        
        // Kirim notifikasi ke reviewer:
        $reviewer = \App\Models\User::find($data['reviewer_user_id']);
        $adminUser = auth()->user();
        if ($reviewer) {
            $reviewer->notify(new \App\Notifications\ProposalAssignedNotification($assignment->proposal, $adminUser));
        }
        
        // Update status proposal menjadi "assigned"
        $proposal = \App\Models\PengajuanPenelitian::find($data['proposal_id']);
        if ($proposal) {
            $proposal->update(['status' => 'Assigned']);
        }
        
        return redirect()->route('pengajuan_penelitian.show', $data['proposal_id'])
                         ->with('success', 'Proposal berhasil diassign ke reviewer.');
    }


}
