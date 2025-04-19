<?php

namespace App\Services;

use App\Models\Models\ModelHistoria;
use Carbon\Carbon;

class HistoriaService
{
    protected $historiaModel;

    public function __construct(ModelHistoria $historiaModel)
    {
        $this->historiaModel = $historiaModel;
    }

    public function cadastrarHistoria($dados)
    {
        return $this->historiaModel->create($dados);
    }

    public function editarHistoria($id, $dados)
    {
        return $this->historiaModel->where('id', $id)->update($dados);
    }

    public function homologarHistoria($id)
    {
        $dataHomologacao = Carbon::now();
        return $this->historiaModel->where('id', $id)->update([
            'status' => 'Concluida',
            'data_homologacao' => $dataHomologacao,
        ]);
    }

    public function cancelarHistoria($id)
    {
        $dataCancelamento = Carbon::now();
        return $this->historiaModel->where('id', $id)->update([
            'status' => 'Cancelada',
            'data_cancelamento' => $dataCancelamento,
        ]);
    }
}
