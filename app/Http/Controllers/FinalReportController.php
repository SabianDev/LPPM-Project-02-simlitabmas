<?php
//kalau error di user() abaikan

namespace App\Http\Controllers;

use App\Models\FinalReport;
use App\Models\Penelitian;
use App\Models\PengajuanPenelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalReportController extends Controller
{
    public function create($penelitianId)
    {
        $penelitian = Penelitian::findOrFail($penelitianId);
        if ($penelitian->user_id !== Auth::id()) {
            abort(403);
        }
        return view('final_report.create', compact('penelitian'));
    }

    public function store(Request $request, $penelitianId)
    {
        $penelitian = Penelitian::findOrFail($penelitianId);
        if ($penelitian->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'final_article' => 'required|file|max:2048',
            'final_report'  => 'required|file|max:2048',
            'final_budget'  => 'required|file|max:2048',
        ]);

        // Upload file-file final report, gunakan storeAs() jika ingin mempertahankan nama file
        $data['final_article'] = $request->file('final_article')->store('final_reports', 'public');
        $data['final_report']  = $request->file('final_report')->store('final_reports', 'public');
        $data['final_budget']  = $request->file('final_budget')->store('final_reports', 'public');
        $data['penelitian_id'] = $penelitian->id;

        FinalReport::create($data);

        // Update status penelitian menjadi "selesai" (atau "finished" jika ingin pakai bahasa Inggris)
        $penelitian->update(['status' => 'selesai']);

        // Juga update status di tabel pengajuan_penelitian yang terkait, misalnya berdasarkan proposal_id
        $proposal = \App\Models\PengajuanPenelitian::find($penelitian->proposal_id);
        if ($proposal) {
            $proposal->update(['status' => 'selesai']);
        }

        // Kirim notifikasi ke admin
        // Misalnya, ambil semua admin (atau admin tertentu)
        $admins = \App\Models\User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\FinalReportSubmittedNotification($penelitian, auth()->user()));
        }

        return redirect()->route('penelitian.show', $penelitian->id)
                         ->with('success', 'Final report berhasil dikirim dan penelitian selesai.');
    }
}
