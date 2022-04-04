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
use App\Http\Controllers\WelcomeController ;
use App\Http\Controllers\MovieController ;
use App\Http\Controllers\SerieController ;
use App\Http\Controllers\CastController ;
use App\Http\Controllers\GenreControler ;

Route::get('/', WelcomeController::class  );
Route::get('/movies', [MovieController::class , 'index'])->name('movie.index');
Route::get('/movies/{movie:slug}', [MovieController::class , 'show'])->name('movie.show');
Route::get('/series', [SerieController::class , 'index'])->name('serie.index');
Route::get('/series/{serie:slug}', [SerieController::class , 'show'])->name('serie.show');
Route::get('/series/{serie:slug}/seasons/{season:slug}', [SerieController::class , 'seasonShow'])->name('season.show');
Route::get('/episodes/{episode:slug}', [SerieController::class , 'showEpisode'])->name('episode.show');
Route::get('/casts', [CastController::class , 'index'])->name('cast.index');
Route::get('/casts/{cast:slug}', [CastController::class , 'show'])->name('cast.show');
Route::get('/genres/{slug}', [GenreControler::class , 'index'])->name('genre.show');


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