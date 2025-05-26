<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiUser;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;

class InformasiUserController extends Controller
{
    // Tampilkan form create/update
    public function form()
    {
        $userId = Auth::id();
        $informasi = InformasiUser::firstOrNew(['user_id' => $userId]);
        $programStudi = ProgramStudi::all();

        // Breakdown TTL jika ada
        $ttl = null;
        if (!empty($informasi->ttl)) {
            $parts = explode(' ', $informasi->ttl);
            if (count($parts) === 3) {
                $ttl = [
                    'day'   => $parts[0],
                    'month' => $parts[1],
                    'year'  => $parts[2],
                ];
            }
        }

        return view('informasi_user.form', compact('informasi', 'programStudi', 'ttl'));
    }

    // Simpan atau update informasi user
    public function simpan(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nidn'                => 'required|string|max:50',
            'nama'                => 'required|string|max:255',
            'prodi'               => 'required|string|max:255',
            'jenjang_pendidikan'  => 'required|string|max:100',
            'jabatan_akademik'    => 'required|string|max:100',
            'bidang_ilmu'         => 'required|string|max:255',
            'sinta_score_overall' => 'nullable|numeric',
            'sinta_score_3_years' => 'nullable|numeric',
            'alamat'              => 'nullable|string|max:255',
            'no_ktp'              => 'nullable|string|max:50',
            'no_hp'               => 'nullable|string|max:20',
            'email'               => 'required|email|max:255',
            'web_personal'        => 'nullable|string|max:255',
        ]);

        $userId = Auth::id();
        $informasi = InformasiUser::firstOrNew(['user_id' => $userId]);

        // Gabungkan ttl jika semua komponen diisi
        $ttl = null;
        if ($request->filled(['ttl_day', 'ttl_month', 'ttl_year'])) {
            $ttl = $request->ttl_day . ' ' . $request->ttl_month . ' ' . $request->ttl_year;
        }

        // Isi data satu per satu
        $informasi->nidn                = $validated['nidn'];
        $informasi->nama                = $validated['nama'];
        $informasi->prodi               = $validated['prodi'];
        $informasi->jenjang_pendidikan  = $validated['jenjang_pendidikan'];
        $informasi->jabatan_akademik    = $validated['jabatan_akademik'];
        $informasi->bidang_ilmu         = $validated['bidang_ilmu'];
        $informasi->sinta_score_overall = $validated['sinta_score_overall'] ?? null;
        $informasi->sinta_score_3_years = $validated['sinta_score_3_years'] ?? null;
        $informasi->alamat              = $validated['alamat'] ?? null;
        $informasi->ttl                 = $ttl;
        $informasi->no_ktp              = $validated['no_ktp'] ?? null;
        $informasi->no_hp               = $validated['no_hp'] ?? null;
        $informasi->email               = $validated['email'];
        $informasi->web_personal        = $validated['web_personal'] ?? null;
        $informasi->user_id             = $userId;

        $informasi->save();

        return redirect()->back()->with('success', 'Informasi berhasil disimpan.');
    }

}
