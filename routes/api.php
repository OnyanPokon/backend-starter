<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HariLayanan\HariLayananController;
use App\Http\Controllers\JadwalKonselor\JadwalKonselorController;
use App\Http\Controllers\Konselis\KonselisController;
use App\Http\Controllers\Konselor\KonselorController;
use App\Http\Controllers\SesiKonseling\SesiKonselingController;
use App\Http\Controllers\Tiket\TiketController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::get("me", "getUser");
        Route::post("logout", "logout");
    });

    Route::prefix('konselis')->controller(KonselisController::class)->group(function () {
        Route::get("/", "index");
        Route::post("/", "store");
        Route::delete("/multi-delete", "multiDestroy");
        Route::get("/{id}", "show");
        Route::put("/{id}", "update");
        Route::delete("/{id}", "destroy");
    });

    Route::prefix('konselor')->controller(KonselorController::class)->group(function () {
        Route::get("/", "index");
        Route::post("/", "store");
        Route::delete("/multi-delete", "multiDestroy");
        Route::get("/{id}", "show");
        Route::put("/{id}", "update");
        Route::delete("/{id}", "destroy");
    });

    Route::prefix('hari_layanan')->controller(HariLayananController::class)->group(function () {
        Route::get("/", "index");
        Route::post("/", "store");
        Route::delete("/multi-delete", "multiDestroy");
        Route::get("/{id}", "show");
        Route::put("/{id}", "update");
        Route::delete("/{id}", "destroy");
    });

    Route::prefix('jadwal_konselor')->controller(JadwalKonselorController::class)->group(function () {
        Route::get("/", "index");
        Route::post("/", "store");
        Route::delete("/multi-delete", "multiDestroy");
        Route::get("/{id}", "show");
        Route::put("/{id}", "update");
        Route::delete("/{id}", "destroy");
    });

    Route::prefix('tiket')->controller(TiketController::class)->group(function () {
        Route::get("/", "index");
        Route::post("/", "store");
        Route::delete("/multi-delete", "multiDestroy");
        Route::get("/{id}", "show");
        Route::put("/{id}", "update");
        Route::delete("/{id}", "destroy");
    });

    Route::prefix('sesi_konseling')->controller(SesiKonselingController::class)->group(function () {
        Route::get("/", "index");
        Route::post("/", "store");
        Route::delete("/multi-delete", "multiDestroy");
        Route::get("/{id}", "show");
        Route::put("/{id}", "update");
        Route::delete("/{id}", "destroy");
    });
});
Route::prefix("auth")->controller(AuthController::class)->group(function () {
    Route::post("login", "login")->name('login');
});
