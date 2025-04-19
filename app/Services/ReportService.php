<?php

namespace App\Services;

use App\Models\Models\ModelHistoria;
use App\Models\Models\ModelRequisito;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportService
{
    protected $requisitoModel;
    protected $historiaModel;

    public function __construct(ModelRequisito $requisitoModel, ModelHistoria $historiaModel)
    {
        $this->requisitoModel = $requisitoModel;
        $this->historiaModel = $historiaModel;
    }

    public function listarRequisitos()
    {
        return $this->requisitoModel->all();
    }

    public function gerarPdfPorId($id)
    {
        $historias = $this->historiaModel
            ->select('id', 'id_user', 'id_requisito', 'id_elicitacao', 'necessidade', 'solucao', 'cenario_teste', 'especificacao', 'status')
            ->where('id', $id)
            ->get();

        return Pdf::loadView('pdfVersao', compact('historias'));
    }

    public function gerarPdfPorFiltro(array $dados)
    {
        $query = $this->historiaModel->select(
            'id', 'id_user', 'id_requisito', 'id_elicitacao',
            'necessidade', 'solucao', 'cenario_teste',
            'especificacao', 'status'
        )->where('id_requisito', $dados['id_requisito']);

        switch ($dados['filtro']) {
            case '1':
                $query->where('status', 'Concluida')
                      ->whereBetween('data_homologacao', [$dados['data_inicial'], $dados['data_final']]);
                break;

            case '2':
                $query->where('status', 'Cancelada')
                      ->whereBetween('data_cancelamento', [$dados['data_inicial'], $dados['data_final']]);
                break;

            case '3':
                $query->where('status', 'Aberto');
                break;

            default:
                return null;
        }

        $historias = $query->get();
        return Pdf::loadView('pdfVersao', compact('historias'));
    }
}
