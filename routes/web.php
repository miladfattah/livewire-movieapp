<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController; 
use App\Http\Livewire\Admin\MovieIndex ;
use App\Http\Livewire\Admin\SerieIndex ;
use App\Http\Livewire\Admin\SeasonIndex ;
use App\Http\Livewire\Admin\EpisodeIndex ;
use App\Http\Livewire\Admin\GenreIndex ;
use App\Http\Livewire\Admin\CastIndex ;
use App\Http\Livewire\Admin\TagIndex ;


Route::get('/', function () {
    // auth()->user()->assingRole('admin');
    return view('welcome');
});

Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/' , [AdminController::class , 'index'])->name('index');
    Route::get('/movies' , MovieIndex::class)->name('movies.index');
    Route::get('/series' , SerieIndex::class)->name('series.index');
    Route::get('/series/{serie}/seasons' , SeasonIndex::class)->name('seasons.index');
    Route::get('/series/{serie}/seasons/{season}/episodes' , EpisodeIndex::class)->name('episodes.index');
    Route::get('/genres' , GenreIndex::class)->name('genres.index');
    Route::get('/casts' , CastIndex::class)->name('casts.index');
    Route::get('/tags' , TagIndex::class)->name('tags.index');
});