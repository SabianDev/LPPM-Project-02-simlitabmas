<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InformasiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\User::query();

        // Filter pencarian berdasarkan nama
        if ($request->filled('search') && $request->filled('filter')) {
            $search = $request->input('search');
            $filter = $request->input('filter');

            // Filter berdasarkan nama
            if ($filter === 'name') {
                $query->where('name', 'LIKE', "%{$search}%");
            }
            // Filter berdasarkan email
            elseif ($filter === 'email') {
                $query->where('email', 'LIKE', "%{$search}%");
            }
            // Filter berdasarkan role
            elseif ($filter === 'role') {
                $query->whereHas('roles', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
            }
        }

        // Paginasi dengan appends untuk mempertahankan parameter query
        $users = $query->orderBy('name')->paginate(5)->appends($request->all());

        return view('users.index', compact('users'));
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
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Klik Edit Data
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        // Cegah update kalau ID user adalah 1 (Master Admin)
        if ($user->id === 1) {
            return redirect()->back()->with('error', 'Master Admin tidak bisa diubah');
        }
        return view('users.edit', compact('user'));
    }

    /**
     * Edit Data
     */
    public function update(Request $request, string $id)
    {
        
        $user = User::findOrFail($id);

        
        if ($user->id === 1) {
            return redirect()->back()->with('error', 'Master Admin tidak bisa diubah');
        }


        // Validasi input
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role'     => 'required|in:admin,user,reviewer',
        ]);

        $user->name  = $data['name'];
        $user->email = $data['email'];

        // Update password jika diisi
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        // Update role user menggunakan Spatie: ini akan menggantikan role yang sudah ada
        $user->syncRoles([$data['role']]);

        return redirect()->route('users.index')
                         ->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Hapus data
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->id == 1) {
            return redirect()->route('users.index')->with('error', 'Akun Master Admin tidak dapat dihapus.');
        }
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'Pengguna berhasil dihapus.');
    }

    public function showInformasi($id)
    {
        $user = User::findOrFail($id);
        $informasi = InformasiUser::where('user_id', $user->id)->first();

        return view('users.informasi_detail', compact('user', 'informasi'));
    }
}
