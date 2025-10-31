<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Escritório de Advocacia
|--------------------------------------------------------------------------
|
| Sistema de gestão para escritório de advocacia com autenticação Sanctum
|
*/

// 🔓 Rotas Públicas — Autenticação
Route::prefix('')->group(function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('registro', [App\Http\Controllers\AuthController::class, 'registro']); // Opcional
});

// 🔒 Rotas Protegidas — Requerem auth:sanctum
Route::middleware('auth:sanctum')->group(function () {
    
    // 🔓 Rotas de autenticação que requerem token
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('user', [App\Http\Controllers\AuthController::class, 'user']);
    
    // 👤 Usuários
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index']);          // Lista usuários
        Route::get('{id}', [App\Http\Controllers\UserController::class, 'show']);       // Detalhes de um usuário
        Route::post('/', [App\Http\Controllers\UserController::class, 'store']);        // Cria novo usuário
        Route::put('{id}', [App\Http\Controllers\UserController::class, 'update']);     // Atualiza usuário
        Route::delete('{id}', [App\Http\Controllers\UserController::class, 'destroy']); // Exclui usuário
    });

    // 👨‍💼 Clientes
    Route::prefix('clients')->group(function () {
        Route::get('/', [App\Http\Controllers\ClientController::class, 'index']);          // Lista clientes
        Route::get('{id}', [App\Http\Controllers\ClientController::class, 'show']);       // Detalhes de um cliente
        Route::post('/', [App\Http\Controllers\ClientController::class, 'store']);        // Cadastra novo cliente
        Route::put('{id}', [App\Http\Controllers\ClientController::class, 'update']);     // Atualiza cliente
        Route::delete('{id}', [App\Http\Controllers\ClientController::class, 'destroy']); // Remove cliente
    });

    // ⚖️ Processos Jurídicos
    Route::prefix('processes')->group(function () {
        Route::get('/', [App\Http\Controllers\ProcessController::class, 'index']);          // Lista processos
        Route::get('{id}', [App\Http\Controllers\ProcessController::class, 'show']);       // Detalhes do processo
        Route::post('/', [App\Http\Controllers\ProcessController::class, 'store']);        // Cria novo processo
        Route::put('{id}', [App\Http\Controllers\ProcessController::class, 'update']);     // Atualiza processo
        Route::delete('{id}', [App\Http\Controllers\ProcessController::class, 'destroy']); // Remove processo
    });

    // 📅 Agenda / Compromissos
    Route::prefix('schedules')->group(function () {
        Route::get('/', [App\Http\Controllers\ScheduleController::class, 'index']);          // Lista compromissos
        Route::get('{id}', [App\Http\Controllers\ScheduleController::class, 'show']);       // Detalhes de um compromisso
        Route::post('/', [App\Http\Controllers\ScheduleController::class, 'store']);        // Cria novo compromisso
        Route::put('{id}', [App\Http\Controllers\ScheduleController::class, 'update']);     // Atualiza compromisso
        Route::delete('{id}', [App\Http\Controllers\ScheduleController::class, 'destroy']); // Remove compromisso
    });

    // 📁 Documentos
    Route::prefix('documents')->group(function () {
        Route::get('/', [App\Http\Controllers\DocumentController::class, 'index']);          // Lista documentos
        Route::get('{id}', [App\Http\Controllers\DocumentController::class, 'show']);       // Detalhes de documento
        Route::post('/', [App\Http\Controllers\DocumentController::class, 'store']);        // Upload de documento
        Route::delete('{id}', [App\Http\Controllers\DocumentController::class, 'destroy']); // Remove documento
    });

    // 💰 Financeiro
    Route::prefix('finances')->group(function () {
        Route::get('/', [App\Http\Controllers\FinanceController::class, 'index']);          // Lista transações
        Route::get('{id}', [App\Http\Controllers\FinanceController::class, 'show']);       // Detalhes de transação
        Route::post('/', [App\Http\Controllers\FinanceController::class, 'store']);        // Cria nova transação
        Route::put('{id}', [App\Http\Controllers\FinanceController::class, 'update']);     // Atualiza transação
        Route::delete('{id}', [App\Http\Controllers\FinanceController::class, 'destroy']); // Remove transação
    });

    // 📊 Dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('overview', [App\Http\Controllers\DashboardController::class, 'overview']); // Estatísticas gerais
    });
});
