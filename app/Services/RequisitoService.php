<?php

namespace App\Services;

use App\Models\Models\ModelRequisito;

class RequisitoService
{
    protected $requisitoModel;
    
    public function __construct(RequisitoService $requisitoService, ElicitacaoService $elicitacaoService)
    {
        $this->requisitoService = $requisitoService;
        $this->elicitacaoService = $elicitacaoService;
    }

    // Método para listar todos os requisitos
    public function listarRequisitos()
    {
        return $this->requisitoModel->all();
    }

    public function cadastrarRequisito($dados)
    {
        return $this->requisitoModel->create([
            'programa' => $dados['programa'],
            'ativo' => 'S',
        ]);
    }

    public function ativarRequisito($id)
    {
        return $this->requisitoModel->where('id', $id)->update(['ativo' => 'S']);
    }

    public function inativarRequisito($id)
    {
        return $this->requisitoModel->where('id', $id)->update(['ativo' => 'N']);
    }

    public function buscarPorId($id)
{
    return $this->modelRequisito->find($id);
}
}
