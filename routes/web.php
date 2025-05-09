<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Korisnik;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmanController;
use App\Http\Controllers\MaterijalController;
use App\Mail\PrijaviMaterijal;



Route::get('/', [HomeController::class, 'index']);

Route::get('/smer-{id}', [MaterijalController::class, 'get_predmeti']);

Route::post('/materijali', [MaterijalController::class, 'get_materijal']);

Route::post('/verifikacija', [HomeController::class, 'verifikuj']);

Route::post('/prijavaMaterijala', function (Request $request) {
    $posiljaoc = $request->input('posiljaoc');
    $materijalId = $request->input('materijalId');
    $opisPrijave = $request->input('opisPrijave');

    Mail::to('janko.petkovic@pmf-arhiv.com')->send(new PrijaviMaterijal($posiljaoc, $materijalId, $opisPrijave));

    return response()->json(['message' => 'Email sent successfully!']);
});