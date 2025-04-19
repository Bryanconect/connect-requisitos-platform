<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElicitacaoRequest;
use App\Services\ElicitacaoService;
use Illuminate\Http\Request;

class ElicitacaoController extends Controller
{
    protected $service;

    public function __construct(ElicitacaoService $service)
    {
        $this->service = $service;
    }

    public function indexelicitacao()
    {
        $elicitacao = $this->service->listarTodas();
        return view('indexelicitacao', compact('elicitacao'));
    }

    public function createelicitacao()
    {
        return view('createelicitacao');
    }

    public function storeelicitacao(ElicitacaoRequest $request)
    {
        $cad = $this->service->criar($request->all());

        if ($cad) {
            return redirect('elicitacao/inicio')
                ->with('mensagem', 'Elicitação cadastrada com sucesso!');
        }
    }

    public function showelicitacao(string $id)
    {
        $elicitacao = $this->service->encontrarPorId($id);
        return view('showelicitacao', compact('elicitacao'));
    }

    public function editelicitacao(string $id)
    {
        if ($this->service->estaAssociadaAHistoria($id)) {
            return redirect('elicitacao/inicio')
                ->with('falha', 'Elicitação associada a história, não é possível editar!');
        }

        $elicitacao = $this->service->encontrarPorId($id);
        return view('editelicitacao', compact('elicitacao'));
    }

    public function updateelicitacao(ElicitacaoRequest $request, string $id)
    {
        $cad = $this->service->atualizar($id, $request->only([
            'titulo', 'tipo', 'setor_envolvido', 'data_reuniao', 'conteudo', 'id_user'
        ]));

        if ($cad) {
            return redirect('elicitacao/inicio')
                ->with('mensagem', 'Elicitação alterada com sucesso!');
        }
    }

    public function excluirelicitacao(string $id)
    {
        if ($this->service->estaAssociadaAHistoria($id)) {
            return redirect('elicitacao/inicio')
                ->with('falha', 'Elicitação associada a história, não é possível deletar!');
        }

        $del = $this->service->deletar($id);

        if ($del) {
            return redirect('elicitacao/inicio')
                ->with('mensagem', 'Elicitação excluída com sucesso!');
        }
    }

    public function download(string $id)
    {
        $elicitacao = $this->service->encontrarPorId($id);
        $mime_type = 'image/png';
        $nome = 'AnexoElicitacao' . $elicitacao->id . '.PNG';
        $file_contents = $elicitacao->imagem;

        return response($file_contents)
            ->header('Cache-Control', 'no-cache private')
            ->header('Content-Description', 'File Transfer')
            ->header('Content-Type', $mime_type)
            ->header('Content-length', strlen($file_contents))
            ->header('Content-Disposition', 'attachment; filename=' . $nome)
            ->header('Content-Transfer-Encoding', 'binary');
    }
}
