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
        try {
            $requisitos = $this->requisitoService->buscarPorId($id);
            $elicitacoes = $this->elicitacaoService->listarTodas();
            return view('createhistoria', compact('requisitos', 'elicitacoes'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro ao carregar dados para criação de história.']);
        }
    }

    public function store(RequisitoRequest $request)
    {
        try {
            $this->requisitoService->cadastrarRequisito($request->validated());
            return redirect('requisitos/inicio')->with('mensagem', 'Requisito cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro ao cadastrar requisito.']);
        }
    }

    public function storeHistoria(HistoriaRequest $request)
    {
        try {
            $this->historiaService->cadastrarHistoria($request->validated());
            return redirect('requisitos/inicio')->with('mensagem', 'História cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro ao cadastrar história.']);
        }
    }

    // Método corrigido: agora o parâmetro é claro para o ID do requisito
    public function indexgestaohistoria($idRequisito)
    {
        try {
            // Verificar se o ID do requisito é válido
            $historiasList = $this->requisitoService->listarHistoriasPorRequisito($idRequisito);
            
            // Retorne a view com as histórias associadas ao requisito
            return view('gestaohistoria', compact('historiasList'));
        } catch (\Exception $e) {
            // Caso haja erro, retornar com mensagem de erro
            return redirect()->back()->withErrors(['erro' => 'Erro ao carregar histórias.']);
        }
    }

    // Métodos para alteração de status de história
    public function homologarhistoria(string $id)
    {
        return $this->alterarStatusHistoria($id, 'homologada');
    }

    public function cancelarhistoria(string $id)
    {
        return $this->alterarStatusHistoria($id, 'cancelada');
    }

    public function alterarStatusHistoria(string $id, string $status)
    {
        try {
            $this->historiaService->alterarStatusHistoria($id, $status);
            return redirect('requisitos/inicio')->with('mensagem', "História {$status} com sucesso!");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro ao alterar status da história.']);
        }
    }

    // Métodos para alteração de status do usuário
    public function autorizarusuario(string $id)
    {
        return $this->alterarStatusUsuario($id, 'autorizado');
    }

    public function tornaradm(string $id)
    {
        return $this->alterarStatusUsuario($id, 'adm');
    }

    public function removeradm(string $id)
    {
        return $this->alterarStatusUsuario($id, 'remover_adm');
    }

    public function cancelarusuario(string $id)
    {
        return $this->alterarStatusUsuario($id, 'cancelado');
    }

    public function alterarStatusUsuario(string $id, string $status)
    {
        try {
            $this->usuarioService->alterarStatusUsuario($id, $status);
            return redirect('gestaousuario')->with('mensagem', "Usuário {$status} com sucesso!");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro ao alterar status do usuário.']);
        }
    }

    // Métodos para alteração de status do requisito
    public function ativarrequisito(string $id)
    {
        return $this->alterarStatusRequisito($id, 'ativo');
    }

    public function inativarrequisito(string $id)
    {
        return $this->alterarStatusRequisito($id, 'inativo');
    }

    public function alterarStatusRequisito(string $id, string $status)
    {
        try {
            $this->requisitoService->alterarStatusRequisito($id, $status);
            return redirect('gestaorequisito')->with('mensagem', "Requisito {$status} com sucesso!");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro ao alterar status do requisito.']);
        }
    }
}
