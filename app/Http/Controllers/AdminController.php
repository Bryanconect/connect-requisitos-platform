<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequisitoRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    public function indexgestaousuario()
    {
        $user = $this->service->listarUsuarios();
        return view('indexgestaousuario', compact('user'));
    }

    public function indexgestaorequisito()
    {
        $requisitos = $this->service->listarRequisitos();
        return view('indexgestaorequisito', compact('requisitos'));
    }

    public function store(RequisitoRequest $request)
    {
        $cad = $this->service->cadastrarRequisito($request->only('programa'));

        if ($cad) {
            return redirect('requisitos/inicio')
                ->with('mensagem', 'Requisito cadastrado com sucesso!');
        }
    }

    public function autorizarusuario(string $id)
    {
        $cad = $this->service->atualizarStatusUsuario($id, ['autorizado' => 'S']);

        if ($cad) {
            return redirect('gestaousuario')
                ->with('mensagem', 'Usuário autorizado com sucesso!');
        }
    }

    public function tornaradm(string $id)
    {
        $cad = $this->service->atualizarStatusUsuario($id, ['tipo' => '1']);

        if ($cad) {
            return redirect('gestaousuario')
                ->with('mensagem', 'Usuário se tornou ADM com sucesso!');
        }
    }

    public function removeradm(string $id)
    {
        $cad = $this->service->atualizarStatusUsuario($id, ['tipo' => '2']);

        if ($cad) {
            return redirect('gestaousuario')
                ->with('mensagem', 'Usuário removido de ADM com sucesso!');
        }
    }

    public function cancelarusuario(string $id)
    {
        $cad = $this->service->atualizarStatusUsuario($id, ['autorizado' => 'N']);

        if ($cad) {
            return redirect('gestaousuario')
                ->with('mensagem', 'Usuário cancelado com sucesso!');
        }
    }

    public function ativarrequisito(string $id)
    {
        $cad = $this->service->atualizarStatusRequisito($id, ['ativo' => 'S']);

        if ($cad) {
            return redirect('gestaorequisito')
                ->with('mensagem', 'Requisito ativo com sucesso!');
        }
    }

    public function inativarusuario(string $id)
    {
        $cad = $this->service->atualizarStatusRequisito($id, ['ativo' => 'N']);

        if ($cad) {
            return redirect('gestaorequisito')
                ->with('mensagem', 'Requisito inativo com sucesso!');
        }
    }
}
