<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPenelitian;
use App\Models\Penelitian;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Statistik untuk Admin
        $totalProposals    = PengajuanPenelitian::count();
        $pendingProposals  = PengajuanPenelitian::where('status', 'pending')->count();
        $approvedProposals = PengajuanPenelitian::where('status', 'approved')->count();
        $rejectedProposals = PengajuanPenelitian::where('status', 'not approved')->count();

        $totalPenelitian    = Penelitian::count();
        $ongoingPenelitian  = Penelitian::where('status', 'on progress')->count();
        $finishedPenelitian = Penelitian::where('status', 'selesai')->count();

        $totalUsers    = \App\Models\User::role('user')->count();
        $totalReviewers = \App\Models\User::role('reviewer')->count();

        // Statistik untuk User
        $totalUserProposals = PengajuanPenelitian::where('user_id', Auth::id())->count();
        $totalUserPenelitian = Penelitian::where('user_id', Auth::id())->count();
        $approvedUserProposals = PengajuanPenelitian::where('user_id', Auth::id())
                                    ->where('status', 'approved')->count();
        $userPenelitianId = Penelitian::where('user_id', Auth::id())
                                ->where('status', 'on progress')->value('id');

        // Statistik untuk Reviewer
        $totalAssignments = \App\Models\ReviewerAssignment::where('reviewer_id', Auth::id())->count();
        $onWorkAssignments = \App\Models\ReviewerAssignment::where('reviewer_id', Auth::id())
                                ->where('assignment_status', 'on_work')->count();
        $completedAssignments = \App\Models\ReviewerAssignment::where('reviewer_id', Auth::id())
                                ->where('assignment_status', 'completed')->count();
        $latestAssignments = \App\Models\ReviewerAssignment::where('reviewer_id', Auth::id())
                                ->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalProposals', 'pendingProposals', 'approvedProposals', 'rejectedProposals',
            'totalPenelitian', 'ongoingPenelitian', 'finishedPenelitian',
            'totalUsers', 'totalReviewers',
            'totalUserProposals', 'totalUserPenelitian', 'approvedUserProposals', 'userPenelitianId',
            'totalAssignments', 'onWorkAssignments','completedAssignments','latestAssignments'
        ));
    }
}
