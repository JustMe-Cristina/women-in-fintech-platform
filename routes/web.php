<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\EventController;


Route::get('/', function () {
    return redirect()->route('members.index');
});

Route::resource('members', MemberController::class);

Route::get('/members/export/csv', [MemberController::class, 'export'])
    ->name('members.export');

Route::get('/members/{member}/stories', [SuccessStoryController::class, 'index'])->name('stories.index');
Route::post('/members/{member}/stories', [SuccessStoryController::class, 'store'])->name('stories.store');
Route::delete('/members/{member}/stories/{story}', [SuccessStoryController::class, 'destroy'])->name('stories.destroy');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
