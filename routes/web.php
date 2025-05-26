<?php
//kalau error di user() abaikan, bakal tetep jalan

use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\PengajuanPenelitianController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\UserProposalController;
use App\Http\Controllers\ReviewerAssignmentController;
use App\Http\Controllers\ReviewerManagementController;
use App\Http\Controllers\ReviewerTampungController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
});

//Dashboard old
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\DashboardController;
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Selain admin dilarang masuk
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/users/{id}/details', [UserController::class, 'showInformasi'])->name('users.informasi');
});

Route::resource('proposals', ProposalController::class);

//Form Pengajuan - Create
Route::middleware(['auth'])->group(function () {
    Route::get('/pengajuan-penelitian/upload', [PengajuanPenelitianController::class, 'create'])->name('pengajuan_penelitian.create');
    Route::post('/pengajuan-penelitian', [PengajuanPenelitianController::class, 'store'])->name('pengajuan_penelitian.store');
});

//Lihat yang sudah upload. Selain admin dilarang masuk
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/lihat-pengajuan-penelitian/{id}', [PengajuanPenelitianController::class, 'show'])->name('pengajuan_penelitian.show');
    Route::get('/lihat-pengajuan-penelitian', [PengajuanPenelitianController::class, 'index'])->name('pengajuan_penelitian.index');
    
});

//manajemen program studi, khusus admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::resource('program_studi', ProgramStudiController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/status-pengajuan-proposal', [UserProposalController::class, 'index'])->name('status_pengajuan_proposal.index');
    Route::get('/status-pengajuan-proposal/{id}', [UserProposalController::class, 'show'])->name('status_pengajuan_proposal.show');
});

//Kirim proposal ke reviewer
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    // Route untuk menampilkan halaman pemilihan reviewer, menerima parameter proposal id
    Route::get('/assign-reviewer/{proposalId}', [ReviewerAssignmentController::class, 'create'])->name('assign_reviewer.create');
    // Route untuk menyimpan assignment
    Route::post('/assign-reviewer', [ReviewerAssignmentController::class, 'store'])->name('assign_reviewer.store');
});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::resource('reviewer_management', ReviewerManagementController::class);
});

Route::middleware(['auth', RoleMiddleware::class . ':reviewer'])->group(function () {
    Route::resource('reviewer_tampung', ReviewerTampungController::class)->only(['index', 'show']);
});

Route::middleware(['auth', RoleMiddleware::class . ':reviewer'])->group(function () {
    Route::resource('reviewer_tampung', ReviewerTampungController::class)->only(['index', 'show']);
    Route::get('/reviewer_return/{assignmentId}', [ReviewerTampungController::class, 'showReturnForm'])->name('reviewer_return.form');
    Route::post('/reviewer_return', [ReviewerTampungController::class, 'storeReturn'])->name('reviewer_return.store');
});

//MODUL USER PROGRESI REPORT & FINAL REPORT

use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\ProgressPenelitianController;
use App\Http\Controllers\FinalReportController;

Route::middleware(['auth'])->group(function () {
    // Modul Penelitian
    Route::resource('penelitian', PenelitianController::class);
    
    // Modul Progress (hanya create dan store, karena progress ditambahkan secara berkala)
    Route::get('penelitian/{penelitianId}/progress', [ProgressPenelitianController::class, 'index'])->name('progress.index');
    Route::get('penelitian/{penelitianId}/progress/create', [ProgressPenelitianController::class, 'create'])->name('progress.create');
    Route::post('penelitian/{penelitianId}/progress', [ProgressPenelitianController::class, 'store'])->name('progress.store');
    Route::get('progress/{id}', [ProgressPenelitianController::class, 'show'])->name('progress.show');

    // Route untuk edit dan update progress
    Route::get('progress/{id}/edit', [ProgressPenelitianController::class, 'edit'])->name('progress.edit');
    Route::put('progress/{id}', [ProgressPenelitianController::class, 'update'])->name('progress.update');
    Route::delete('progress/{id}', [ProgressPenelitianController::class, 'destroy'])->name('progress.destroy');

    

    // Modul Final Report
    Route::get('penelitian/{penelitianId}/final-report/create', [FinalReportController::class, 'create'])->name('final_report.create');
    Route::post('penelitian/{penelitianId}/final-report', [FinalReportController::class, 'store'])->name('final_report.store');
});

// Route::middleware(['auth'])->group(function () {
//     //Modul Penelitian
//     Route::resource('penelitian', PenelitianController::class);
    
//     // Route untuk menampilkan form tambah progress berdasarkan id penelitian (parent)
//     Route::get('penelitian/{penelitianId}/progress/create', [ProgressPenelitianController::class, 'create'])->name('progress.create');
    
//     // Route untuk menyimpan progress baru
//     Route::post('penelitian/{penelitianId}/progress', [ProgressPenelitianController::class, 'store'])->name('progress.store');
    
//     // Route untuk menampilkan detail progress
//     Route::get('progress/{id}', [ProgressPenelitianController::class, 'show'])->name('progress.show');
    
//     // Route untuk menampilkan form edit progress
//     Route::get('progress/{id}/edit', [ProgressPenelitianController::class, 'edit'])->name('progress.edit');
    
//     // Route untuk mengupdate progress
//     Route::put('progress/{id}', [ProgressPenelitianController::class, 'update'])->name('progress.update');
    
//     // Route untuk menghapus progress
//     Route::delete('progress/{id}', [ProgressPenelitianController::class, 'destroy'])->name('progress.destroy');
// });


//Penelitian dan Progress Khusus Admin
use App\Http\Controllers\PenelitianAdminController;
use App\Http\Controllers\ProgressAdminController;
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::resource('penelitian_admin', PenelitianAdminController::class)->only(['index', 'show']);
});


Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('admin/progress/{id}', [\App\Http\Controllers\ProgressAdminController::class, 'show'])->name('admin.progress.show');
});

use App\Http\Controllers\NotificationController;

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');

});

use App\Http\Controllers\InformasiUserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/informasi-user', [InformasiUserController::class, 'form'])->name('informasi_user.form');
    Route::post('/informasi-user/simpan', [InformasiUserController::class, 'simpan'])->name('informasi_user.simpan');
});


require __DIR__.'/auth.php';
