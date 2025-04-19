<?php

// ElicitacaoService.php
namespace App\Services;

use App\Models\Models\ModelElicitacao;
use App\Models\Models\ModelHistoria;

class ElicitacaoService
{
    protected $elicitacao;
    protected $historia;

    public function __construct(RequisitoService $requisitoService, ElicitacaoService $elicitacaoService)
    {
        $this->requisitoService = $requisitoService;
        $this->elicitacaoService = $elicitacaoService;
    }

    public function listarTodas()
    {
        return $this->elicitacao->all();
    }

    public function criar(array $dados)
    {
        return $this->elicitacao->create($dados);
    }

    public function encontrarPorId($id)
    {
        return $this->elicitacao->find($id);
    }

    public function atualizar($id, array $dados)
    {
        return $this->elicitacao->where('id', $id)->update($dados);
    }

    public function deletar($id)
    {
        return $this->elicitacao->destroy($id);
    }

    public function estaAssociadaAHistoria($id)
    {
        return $this->historia->where('id_elicitacao', $id)->exists();
    }
}
