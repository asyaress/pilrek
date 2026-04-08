<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\NewsPostController;
use App\Http\Controllers\Admin\RectorCandidateController;
use App\Http\Controllers\Admin\RectorRequirementController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TimelineStageController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/timeline', [PageController::class, 'timeline'])->name('timeline');
Route::get('/calon-rektor', [PageController::class, 'candidates'])->name('calon-rektor');
Route::get('/calon-rektor/{slug}', [PageController::class, 'candidateDetail'])->name('calon-rektor.detail');
Route::get('/persyaratan-calon-rektor', [PageController::class, 'requirements'])->name('persyaratan');
Route::get('/berita', [PageController::class, 'news'])->name('berita');
Route::get('/berita/{slug}', [PageController::class, 'newsDetail'])->name('berita.detail');
Route::get('/publikasi/{slug?}', [PageController::class, 'publication'])->name('publikasi');
Route::redirect('/kontak', '/');
Route::view('/career', 'pages.career')->name('career');
Route::view('/price', 'pages.price')->name('price');
Route::view('/register', 'pages.register')->name('register');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::view('/', 'pages.admin.dashboard')->name('dashboard');
        Route::view('/konten', 'pages.admin.content')->name('content')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/users', [UserManagementController::class, 'index'])->name('users')
            ->middleware('admin.role:super_admin');
        Route::post('/users', [UserManagementController::class, 'store'])->name('users.store')
            ->middleware('admin.role:super_admin');
        Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit')
            ->middleware('admin.role:super_admin');
        Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update')
            ->middleware('admin.role:super_admin');
        Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy')
            ->middleware('admin.role:super_admin');
        Route::get('/timeline', [TimelineStageController::class, 'index'])->name('timeline.index')
            ->middleware('admin.role:super_admin,editor');
        Route::post('/timeline', [TimelineStageController::class, 'store'])->name('timeline.store')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/timeline/{timelineStage}/edit', [TimelineStageController::class, 'edit'])->name('timeline.edit')
            ->middleware('admin.role:super_admin,editor');
        Route::put('/timeline/{timelineStage}', [TimelineStageController::class, 'update'])->name('timeline.update')
            ->middleware('admin.role:super_admin,editor');
        Route::delete('/timeline/{timelineStage}', [TimelineStageController::class, 'destroy'])->name('timeline.destroy')
            ->middleware('admin.role:super_admin,editor');
        Route::post('/timeline/{timelineStage}/move', [TimelineStageController::class, 'move'])->name('timeline.move')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/candidates', [RectorCandidateController::class, 'index'])->name('candidates.index')
            ->middleware('admin.role:super_admin,editor');
        Route::post('/candidates', [RectorCandidateController::class, 'store'])->name('candidates.store')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/candidates/{candidate}/edit', [RectorCandidateController::class, 'edit'])->name('candidates.edit')
            ->middleware('admin.role:super_admin,editor');
        Route::put('/candidates/{candidate}', [RectorCandidateController::class, 'update'])->name('candidates.update')
            ->middleware('admin.role:super_admin,editor');
        Route::delete('/candidates/{candidate}', [RectorCandidateController::class, 'destroy'])->name('candidates.destroy')
            ->middleware('admin.role:super_admin,editor');
        Route::post('/candidates/{candidate}/move', [RectorCandidateController::class, 'move'])->name('candidates.move')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/requirements', [RectorRequirementController::class, 'index'])->name('requirements.index')
            ->middleware('admin.role:super_admin,editor');
        Route::post('/requirements', [RectorRequirementController::class, 'store'])->name('requirements.store')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/requirements/{requirement}/edit', [RectorRequirementController::class, 'edit'])->name('requirements.edit')
            ->middleware('admin.role:super_admin,editor');
        Route::put('/requirements/{requirement}', [RectorRequirementController::class, 'update'])->name('requirements.update')
            ->middleware('admin.role:super_admin,editor');
        Route::delete('/requirements/{requirement}', [RectorRequirementController::class, 'destroy'])->name('requirements.destroy')
            ->middleware('admin.role:super_admin,editor');
        Route::post('/requirements/{requirement}/move', [RectorRequirementController::class, 'move'])->name('requirements.move')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/news', [NewsPostController::class, 'index'])->name('news.index')
            ->middleware('admin.role:super_admin,editor');
        Route::post('/news', [NewsPostController::class, 'store'])->name('news.store')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/news/media/library', [NewsPostController::class, 'mediaLibrary'])->name('news.media.library')
            ->middleware('admin.role:super_admin,editor');
        Route::post('/news/media/upload', [NewsPostController::class, 'uploadEditorImage'])->name('news.media.upload')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/news/{news}/edit', [NewsPostController::class, 'edit'])->name('news.edit')
            ->middleware('admin.role:super_admin,editor');
        Route::put('/news/{news}', [NewsPostController::class, 'update'])->name('news.update')
            ->middleware('admin.role:super_admin,editor');
        Route::delete('/news/{news}', [NewsPostController::class, 'destroy'])->name('news.destroy')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show')
            ->middleware('admin.role:super_admin,editor');
        Route::post('/messages/{message}/read', [ContactMessageController::class, 'markAsRead'])->name('messages.read')
            ->middleware('admin.role:super_admin,editor');
        Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy')
            ->middleware('admin.role:super_admin,editor');
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity.index')
            ->middleware('admin.role:super_admin');
        Route::get('/settings', [SiteSettingController::class, 'edit'])->name('settings.edit')
            ->middleware('admin.role:super_admin');
        Route::post('/settings', [SiteSettingController::class, 'update'])->name('settings.update')
            ->middleware('admin.role:super_admin');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
