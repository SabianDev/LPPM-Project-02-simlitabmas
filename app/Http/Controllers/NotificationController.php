<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Menampilkan daftar notifikasi dengan paginasi
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(5);
        return view('notifications.index', compact('notifications'));
    }

    // Menghapus notifikasi
    public function destroy($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    public function destroyAll()
    {
        $user = Auth::user();
        $user->notifications()->delete();

        return redirect()->back()->with('success', 'Semua notifikasi berhasil dihapus.');
    }

}
