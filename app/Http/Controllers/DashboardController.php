<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    /**
     * Estatísticas gerais do dashboard
     * GET /api/dashboard/overview
     */
    public function overview(Request $request): JsonResponse
    {
        // Aqui você pode implementar as estatísticas baseadas nas suas tabelas
        // Por exemplo:
        
        $stats = [
            'total_clientes' => 0, // \App\Models\Cliente::count(),
            'total_processos' => 0, // \App\Models\Processo::count(),
            'processos_ativos' => 0, // \App\Models\Processo::where('status', 'ativo')->count(),
            'processos_arquivados' => 0, // \App\Models\Processo::where('status', 'arquivado')->count(),
            'prazos_pendentes' => 0, // \App\Models\Prazo::where('status', 'pendente')->count(),
            'prazos_vencidos' => 0, // \App\Models\Prazo::where('status', 'vencido')->count(),
            'eventos_hoje' => 0, // \App\Models\Evento::whereDate('data_inicio', today())->count(),
            'documentos_total' => 0, // \App\Models\Documento::count(),
            'usuarios_ativos' => 0, // \App\Models\User::where('ativo', true)->count(),
        ];

        $processos_por_status = [
            'ativo' => 0, // \App\Models\Processo::where('status', 'ativo')->count(),
            'arquivado' => 0, // \App\Models\Processo::where('status', 'arquivado')->count(),
            'vencido' => 0, // \App\Models\Processo::where('status', 'vencido')->count(),
        ];

        $prazos_proximos = [
            // \App\Models\Prazo::where('status', 'pendente')
            //     ->where('data_limite', '>=', now())
            //     ->where('data_limite', '<=', now()->addDays(7))
            //     ->with(['processo', 'responsavel'])
            //     ->orderBy('data_limite')
            //     ->limit(5)
            //     ->get()
        ];

        return response()->json([
            'message' => 'Estatísticas gerais do dashboard',
            'data' => [
                'estatisticas_gerais' => $stats,
                'processos_por_status' => $processos_por_status,
                'prazos_proximos' => $prazos_proximos,
                'ultima_atualizacao' => now()->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
