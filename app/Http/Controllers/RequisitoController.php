<?php

namespace App\Http\Controllers;

use App\Services\RequisitoService;
use App\Services\UsuarioService;
use App\Services\HistoriaService;
use App\Http\Requests\RequisitoRequest;
use App\Http\Requests\HistoriaRequest;

class RequisitoController extends Controller
{
    protected $requisitoService;
    protected $usuarioService;
    protected $historiaService;

    public function __construct(
        RequisitoService $requisitoService,
        UsuarioService $usuarioService,
        HistoriaService $historiaService
    ) {
        $this->requisitoService = $requisitoService;
        $this->usuarioService = $usuarioService;
        $this->historiaService = $historiaService;
    }

    public function index()
    {
        $requisitos = $this->requisitoService->listarRequisitos();
        return view('indexrequisito', compact('requisitos'));
    }

    public function create()
    {
        return view('createrequisito');
    }

    public function createhistoria(string $id)
{
    $requisitos = $this->requisitoService->buscarPorId($id);
    $elicitacoes = $this->elicitacaoService->listarTodas();

    return view('createhistoria', compact('requisitos', 'elicitacoes'));
}


    public function store(RequisitoRequest $request)
    {
        $cadastro = $this->requisitoService->cadastrarRequisito($request->all());
        if ($cadastro) {
            return redirect('requisitos/inicio')->with('mensagem', 'Requisito cadastrado com sucesso!');
        }
    }

    public function storeHistoria(HistoriaRequest $request)
    {
        $cadastro = $this->historiaService->cadastrarHistoria($request->all());
        if ($cadastro) {
            return redirect('requisitos/inicio')->with('mensagem', 'História cadastrada com sucesso!');
        }
    }

    public function homologarhistoria(string $id)
    {
        $cadastro = $this->historiaService->homologarHistoria($id);
        if ($cadastro) {
            return redirect('requisitos/inicio')->with('mensagem', 'História homologada com sucesso!');
        }
    }

    public function cancelarhistoria(string $id)
    {
        $cadastro = $this->historiaService->cancelarHistoria($id);
        if ($cadastro) {
            return redirect('requisitos/inicio')->with('mensagem', 'História cancelada com sucesso!');
        }
    }

    public function autorizarusuario(string $id)
    {
        $cadastro = $this->usuarioService->autorizarUsuario($id);
        if ($cadastro) {
            return redirect('gestaousuario')->with('mensagem', 'Usuário autorizado com sucesso!');
        }
    }

    public function tornaradm(string $id)
    {
        $cadastro = $this->usuarioService->tornarAdmin($id);
        if ($cadastro) {
            return redirect('gestaousuario')->with('mensagem', 'Usuário se tornou ADM com sucesso!');
        }
    }

    public function removeradm(string $id)
    {
        $cadastro = $this->usuarioService->removerAdmin($id);
        if ($cadastro) {
            return redirect('gestaousuario')->with('mensagem', 'Usuário removido de ADM com sucesso!');
        }
    }

    public function cancelarusuario(string $id)
    {
        $cadastro = $this->usuarioService->cancelarUsuario($id);
        if ($cadastro) {
            return redirect('gestaousuario')->with('mensagem', 'Usuário cancelado com sucesso!');
        }
    }

    public function ativarrequisito(string $id)
    {
        $cadastro = $this->requisitoService->ativarRequisito($id);
        if ($cadastro) {
            return redirect('gestaorequisito')->with('mensagem', 'Requisito ativo com sucesso!');
        }
    }

    public function inativarrequisito(string $id)
    {
        $cadastro = $this->requisitoService->inativarRequisito($id);
        if ($cadastro) {
            return redirect('gestaorequisito')->with('mensagem', 'Requisito inativo com sucesso!');
        }
    }
}
