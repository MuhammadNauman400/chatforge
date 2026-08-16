<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ChatbotController;
use App\Http\Controllers\Admin\KnowledgeDocumentController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/////// User Accessable Routes
Route::middleware(['auth', IsUser::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});



/////// Admin Accessable Routes
Route::middleware(['auth', IsAdmin::class])->group(function () {


    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

    //// Plan Routes  -- group controller
    Route::controller(PlanController::class)->group(function () {
        Route::get('/all/plans', 'AllPlans')->name('all.plans');
        Route::get('/add/plans', 'AddPlans')->name('add.plans');
        Route::post('/store/plans', 'StorePlans')->name('store.plans');
        Route::get('/edit/plans/{id}', 'EditPlans')->name('edit.plans');
        Route::post('/update/plans', 'UpdatePlans')->name('update.plans');
        Route::get('/delete/plans{id}', 'DeletePlans')->name('delete.plans');
    });


});
/////// End Admin Routes


/// Knowledge Document Routes
Route::middleware('auth')->group(function () {

    Route::get('/knowledge-documents', [KnowledgeDocumentController::class, 'Index'])->name('knowledge-documents.index');
    Route::post('/knowledge-documents', [KnowledgeDocumentController::class, 'Store'])->name('knowledge-documents.store');
    Route::delete('/knowledge-documents/{document}', [KnowledgeDocumentController::class, 'DocDelete']);

    Route::get('/knowledge/page', [KnowledgeDocumentController::class, 'KnowledgePage'])->name('knowledge.page');
});

///Chatbot Routes
Route::middleware('auth')->group(function () {

    Route::get('/chatbot/page', [ChatbotController::class, 'ChatbotPage'])->name('chatbot.page');

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
