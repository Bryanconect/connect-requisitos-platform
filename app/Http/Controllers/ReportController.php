<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $service;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
    }

    public function relatorios()
    {
        $requisitos = $this->service->listarRequisitos();
        return view('relatorios', compact('requisitos'));
    }

    public function geraPdf(string $id)
    {
        $pdf = $this->service->gerarPdfPorId($id);
        return $pdf->stream('versaohistoria.pdf');
    }

    public function tipogeracao(Request $request)
    {
        $pdf = $this->service->gerarPdfPorFiltro($request->all());

        if ($pdf) {
            return $pdf->stream('versaohistoria.pdf');
        }

        return redirect()->back()->with('erro', 'Filtro inválido ou nenhum dado encontrado.');
    }
}
