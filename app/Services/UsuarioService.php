<?php

namespace App\Services;

use App\Models\User;

class UsuarioService
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function autorizarUsuario($id)
    {
        return $this->userModel->where('id', $id)->update(['autorizado' => 'S']);
    }

    public function tornarAdmin($id)
    {
        return $this->userModel->where('id', $id)->update(['tipo' => '1']);
    }

    public function removerAdmin($id)
    {
        return $this->userModel->where('id', $id)->update(['tipo' => '2']);
    }

    public function cancelarUsuario($id)
    {
        return $this->userModel->where('id', $id)->update(['autorizado' => 'N']);
    }
}
