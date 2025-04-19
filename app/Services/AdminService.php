<?php

namespace App\Services;

use App\Models\Models\ModelRequisito;
use App\Models\User;

class AdminService
{
    protected $userModel;
    protected $requisitoModel;

    public function __construct(User $userModel, ModelRequisito $requisitoModel)
    {
        $this->userModel = $userModel;
        $this->requisitoModel = $requisitoModel;
    }

    public function listarUsuarios()
    {
        return $this->userModel->all();
    }

    public function listarRequisitos()
    {
        return $this->requisitoModel->all();
    }

    public function cadastrarRequisito(array $dados)
    {
        $dados['ativo'] = 'S';
        return $this->requisitoModel->create($dados);
    }

    public function atualizarStatusUsuario($id, $dados)
    {
        return $this->userModel->where('id', $id)->update($dados);
    }

    public function atualizarStatusRequisito($id, $dados)
    {
        return $this->requisitoModel->where('id', $id)->update($dados);
    }
}
