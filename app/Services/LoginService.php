<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function autenticarUsuario($email, $senha)
    {
        $user = $this->userModel
            ->select('id', 'email', 'senha')
            ->where('autorizado', 'S')
            ->where('email', $email)
            ->first();

        if (!$user) {
            return ['success' => false, 'message' => 'Email inválido ou sem autorização.'];
        }

        if ($user->senha === $senha) {
            Auth::loginUsingId($user->id);
            return ['success' => true];
        }

        return ['success' => false, 'message' => 'Senha inválida.'];
    }

    public function logout()
    {
        Auth::logout();
    }

    public function criarUsuario(array $dados)
    {
        // Verifica se e-mail já existe
        $user = $this->userModel
            ->where('email', $dados['email'])
            ->first();

        if ($user) {
            return ['success' => false, 'message' => 'Email já existente na base.'];
        }

        $dados['tipo'] = '2';
        $dados['autorizado'] = 'N';

        $novoUsuario = $this->userModel->create($dados);

        return ['success' => (bool) $novoUsuario];
    }
}
