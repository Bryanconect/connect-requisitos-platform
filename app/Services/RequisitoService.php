<?php

namespace App\Services;

use App\Models\Models\ModelRequisito;
use App\Models\Models\ModelHistoria;

class RequisitoService
{
    protected $requisitoModel;
    protected $historia;

    public function __construct(ModelRequisito $requisitoModel, ModelHistoria $historia)
    {
        $this->requisitoModel = $requisitoModel;
        $this->historia = $historia;
    }

    // Método para listar todos os requisitos, com opção de limitar e paginar
    public function listarRequisitos($limit = 10)
    {
        return $this->requisitoModel->limit($limit)->get();
    }

    // Método para listar as histórias associadas a um requisito
    public function listarHistoriasPorRequisito($idRequisito)
    {
        // Verificar se o requisito existe e então retornar as histórias associadas
        return $this->historia->where('requisito_id', $idRequisito)->get(); // 'requisito_id' é a chave estrangeira
    }

    // Método para cadastrar um requisito
    public function cadastrarRequisito(array $dados)
    {
        return $this->requisitoModel->create([
            'programa' => $dados['programa'],
            'ativo' => 'S',
        ]);
    }

    // Método para alterar o status de um requisito (ativo ou inativo)
    public function alterarStatusRequisito($id, $status)
    {
        return $this->requisitoModel->where('id', $id)->update(['ativo' => $status === 'ativo' ? 'S' : 'N']);
    }

    // Método para buscar requisito por ID
    public function buscarPorId($id)
    {
        return $this->requisitoModel->find($id);
    }
}
