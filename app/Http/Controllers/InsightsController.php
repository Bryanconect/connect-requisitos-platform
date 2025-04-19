<?php

namespace App\Http\Controllers;

use App\Services\InsightsService;

class InsightsController extends Controller
{
    protected $service;

    public function __construct(InsightsService $service)
    {
        $this->service = $service;
    }

    public function getInsightsForRequirement($id)
    {
        $resultado = $this->service->gerarInsightsParaHistoria($id);

        if (!$resultado['success']) {
            return response()->json(['message' => $resultado['message']], 404);
        }

        return redirect('requisitos/inicio')->with('mensagem', 'Insight gerado com sucesso!');
    }
}
