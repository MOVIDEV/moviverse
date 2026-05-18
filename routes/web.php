<?php

use App\Http\Controllers\Admin\AdminClaimsFnfController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FNF\FnfSubmissionController;
use App\Http\Controllers\Admin\AdminFnfController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FNF\FnfDashboardController;
use App\Http\Controllers\FNF\FnfRewardClaimController;



// Route::get('/', function () {
//     return view('auth/login');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:1'])->group(function () {

    // Route::get('/admin/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


    // reviewFNF

    Route::get('/fnf', [AdminFnfController::class, 'index'])->name('admin.fnf.index');

    Route::get('/fnf/datafnf', [AdminFnfController::class, 'datafnf'])->name('admin.fnf.datafnf');

    Route::post('/fnf/{id}/approve', [AdminFnfController::class, 'approve'])->name('admin.fnf.datafnf.approve');

    Route::post('/fnf/{id}/next-step', [AdminFnfController::class, 'nextStep'])->name('admin.fnf.nextStep');

    Route::post('/fnf/{id}/reject', [AdminFnfController::class, 'reject'])->name('admin.fnf.reject');

    // review claims

    Route::get('/fnf/claimsfnf', [AdminClaimsFnfController::class, 'index'])->name('admin.fnf.claims.claimsfnf');

    Route::post('/fnf/{id}/approved', [AdminClaimsFnfController::class, 'approved'])->name('admin.fnf.claims.claimsfnf.approved');
});

Route::middleware(['auth', 'role:2'])->group(function () {

    // Route::get('/fnf/dashboard', function () {
    //     return view('fnf.dashboard');
    // })->name('fnf.dashboard');

    Route::get('/fnf/dashboard', [FnfDashboardController::class, 'index'])
        ->name('fnf.dashboard');

    // submission fnf
    Route::get('/submission', [FnfSubmissionController::class, 'index'])
        ->name('fnf.submission');

    Route::post('/submission', [FnfSubmissionController::class, 'store'])
        ->name('fnf.submission.store');

    Route::post('/submission/upload', [FnfSubmissionController::class, 'upload'])
        ->name('fnf.submission.upload');

    Route::post('/submission/submit', [FnfSubmissionController::class, 'submit'])->name('fnf.submission.submit');

    // claim

    Route::get('/fnf/rewards', [FnfRewardClaimController::class, 'index'])->name('fnf.rewards.index');

    Route::post(
        '/fnf/reward-claim/{submission}',
        [FnfRewardClaimController::class, 'claim']
    )->name('fnf.reward.claim');
});





// Route::middleware(['auth'])->group(function () {

//     Route::get('/admin/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');

//     Route::get('/fnf/dashboard', function () {
//         return view('fnf.dashboard');
//     })->name('fnf.dashboard');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
