<?php

namespace App\Services;

use App\Models\Models\ModelElicitacao;
use App\Models\Models\ModelHistoria;

class ElicitacaoService
{
    protected $elicitacao;
    protected $historia;

    // Construtor corrigido
    public function __construct(ModelElicitacao $elicitacao, ModelHistoria $historia)
    {
        $this->elicitacao = $elicitacao;
        $this->historia = $historia;
    }

    // Método para listar todas as elicitações
    public function listarTodas()
    {
        return $this->elicitacao->all();
    }

    // Método para criar uma nova elicitação
    public function criar(array $dados)
    {
        return $this->elicitacao->create($dados);
    }

    // Método para encontrar uma elicitação por ID
    public function encontrarPorId($id)
    {
        return $this->elicitacao->find($id);
    }

    // Método para atualizar uma elicitação
    public function atualizar($id, array $dados)
    {
        return $this->elicitacao->where('id', $id)->update($dados);
    }

    // Método para deletar uma elicitação
    public function deletar($id)
    {
        return $this->elicitacao->destroy($id);
    }

    // Verifica se a elicitação está associada a uma história
    public function estaAssociadaAHistoria($id)
    {
        return $this->historia->where('id_elicitacao', $id)->exists();
    }
}
