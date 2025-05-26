<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPenelitian;
use App\Models\AnggotaPenelitian;
use App\Models\AnggotaPenelitianMahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanPenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PengajuanPenelitian::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $filterBy = $request->input('filter_by', 'nama_lengkap'); // default ke nama_lengkap

            // Daftar kolom yang boleh difilter
            $allowedFilters = ['nama_lengkap', 'judul_penelitian', 'prodi', 'status', 'created_at'];

            // Jika filter_by valid, baru apply pencarian
            if (in_array($filterBy, $allowedFilters)) {
                // Khusus untuk created_at (tanggal upload), cari berdasarkan format tanggal
                if ($filterBy === 'created_at') {
                    $query->whereDate('created_at', $search);
                } else {
                    $query->where($filterBy, 'LIKE', "%{$search}%");
                }
            }
        }

        $pengajuan = $query->orderBy('created_at', 'desc')->paginate(5)->appends([
            'search' => $request->input('search'),
            'filter_by' => $request->input('filter_by'),
        ]);
        return view('pengajuan_penelitian.index', compact('pengajuan'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $program_studi = \App\Models\ProgramStudi::all();

        // Ambil user dengan role 'user' pakai spatie permission
        $eligibleUsers = \App\Models\User::role('user')->get();

        return view('pengajuan_penelitian.create', compact('program_studi', 'eligibleUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());  //buat debug
        $validated = $request->validate([
            'tahun_penelitian' => 'required|numeric|digits:4',
            'judul_penelitian' => 'required|string|max:255',
            'nidn_ketua'       => 'required|string|max:255',
            'jabatan'          => 'required|string|max:255',
            'nama_lengkap'     => 'required|string|max:255',
            'prodi'            => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'no_wa'            => 'required|string|max:20',
            'skema_usulan'     => 'required|in:Penelitian Dasar,Penelitian Kompetitif,PKM (Pemberdayaan Dasar),Subsidi',
            'file_proposal'    => 'required|file|max:1024',
            // note: anggota_tim dan anggota_mahasiswa opsional, jadi tidak divalidasi di sini
        ]);

        // tambahkan user_id & status
        $validated['user_id'] = Auth::id();
        $validated['status']  = 'Pending';

        // upload file
        if ($request->hasFile('file_proposal')) {
            $file     = $request->file('file_proposal');
            $filename = time().'_'.uniqid().'_'.$file->getClientOriginalName();
            $path     = $file->storeAs('proposal_uploads', $filename, 'public');
            $validated['file_proposal'] = $path;
        }

        // buat proposal
        $proposal = \App\Models\PengajuanPenelitian::create($validated);

        // simpan anggota dosen (jika ada)
        if ($request->filled('anggota_tim') && is_array($request->input('anggota_tim'))) {
            foreach ($request->input('anggota_tim') as $anggotaId) {
                if (!empty($anggotaId)) {
                    \App\Models\AnggotaPenelitian::create([
                        'id_proposal' => $proposal->id,
                        'id_user'     => $anggotaId,
                    ]);
                }
            }
        }

        // simpan anggota mahasiswa (jika ada)
        if ($request->filled('anggota_mahasiswa') && is_array($request->input('anggota_mahasiswa'))) {
            foreach ($request->input('anggota_mahasiswa') as $npmNama) {
                if (!empty(trim($npmNama))) {
                    \App\Models\AnggotaPenelitianMahasiswa::create([
                        'id_proposal'        => $proposal->id,
                        'npm_nama_mahasiswa' => $npmNama,
                    ]);
                }
            }
        }

        // kirim notifikasi ke admin
        if ($admin = \App\Models\User::role('admin')->first()) {
            $admin->notify(new \App\Notifications\ProposalSubmittedNotification($proposal, Auth::user()));
        }

        return redirect()->back()->with('success', 'Pengajuan penelitian berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengajuan = \App\Models\PengajuanPenelitian::with('anggota.user')->findOrFail($id);
        return view('pengajuan_penelitian.show', compact('pengajuan'));
        
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
