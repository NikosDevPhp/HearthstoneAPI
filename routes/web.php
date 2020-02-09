<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('cards.index', [
        'cards' => App\Card::all()
    ]);
});

Route::get('/search', function (\App\Repositories\CardsRepository $repository) {
    $cards = $repository->search((string) request('q'));

    return view('cards.index', [
        'cards' => $cards
    ]);
});
