<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginService;

class LoginController extends Controller
{
    protected $service;

    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('login');
    }

    public function criarusuario()
    {
        return view('createuser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ], [
            'email.required' => 'Esse campo de email é obrigatório',
            'email.email' => 'Esse campo tem que ter um email válido',
            'senha.required' => 'Esse campo password é obrigatório',
        ]);

        $resultado = $this->service->autenticarUsuario($request->email, $request->senha);

        if ($resultado['success']) {
            return redirect()->route('login.index')->with('success', 'Logged in');
        } else {
            return redirect()->route('login.index')->withErrors(['error' => $resultado['message']]);
        }
    }

    public function destroy()
    {
        $this->service->logout();
        return redirect()->route('login.index');
    }

    public function storeusuario(Request $request)
    {
        $resultado = $this->service->criarUsuario($request->only('name', 'email', 'senha'));

        if (!$resultado['success']) {
            return redirect()->route('login.criarusuario')->withErrors(['error' => $resultado['message']]);
        }

        return redirect('/login')->with('mensagem', 'Solicitação de acesso realizada, aguarde o contato do ADM.');
    }
}
