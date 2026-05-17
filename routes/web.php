<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\MailboxController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\BlogPostCreate;
use App\Livewire\Admin\BlogPostManage;
use App\Livewire\Admin\ForumCategoryManage;
use App\Livewire\Admin\MailboxSend;
use App\Livewire\Message\Compose;
use App\Livewire\Profile\Edit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');

Route::controller(BlogController::class)->prefix('blog')->name('blog.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('{post:slug}', 'show')->name('show');
});

Route::controller(ForumController::class)->prefix('forums')->name('forums.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('create/{category:slug}', 'create')->middleware('auth')->name('create');
    Route::get('{category:slug}', 'category')->name('category');
    Route::get('{category:slug}/{forumPost:slug}', 'show')->name('show');
});

Route::get('users/{user}', [ProfileController::class, 'show'])->name('profile.show');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        Route::get('compose/{recipientId?}', Compose::class)
            ->whereNumber('recipientId')
            ->name('compose');
        Route::get('{conversationId}', [MessageController::class, 'show'])
            ->whereNumber('conversationId')
            ->name('show');
    });

    Route::controller(MailboxController::class)->prefix('mailbox')->name('mailbox.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('{messageId}', 'show')->name('show');
    });

    Route::get('profile/edit', Edit::class)->name('profile.settings');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', BlogPostManage::class)->name('index');
        Route::get('create', BlogPostCreate::class)->name('create');
    });

    Route::get('mailbox/send', MailboxSend::class)->name('mailbox.send');
    Route::get('forums', ForumCategoryManage::class)->name('forums.index');
});

require __DIR__.'/settings.php';
