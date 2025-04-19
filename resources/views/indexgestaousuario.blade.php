@extends('templates.template')

@section('content')

@php
$uservalidation = auth()->user()->tipo;
$userelicitacao = auth()->user()->id;
@endphp

<div class="text-center mt-3 mb-4">


        <a href="{{url("requisitos/inicio")}}">
          <button class="btn btn-danger"> Voltar </button>
        </a>
</div>

@if(session('mensagem'))
<div class="text-center mt-3 mb-4 alert alert-success">
        <p>{{session('mensagem')}}</p>
    </div>
@endif 

<h1 class="text-center">Gerenciar Usuários</h1>

<div class="col-8 m-auto"> 
  @csrf
<table class="table text-center">

  <thead class="table-dark">
  <tr>
      <th scope="col">Nome</th>
      <th scope="col">Usuário</th>
      <th scope="col">Autorizado</th>
      <th scope="col">Tipo</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>

  @foreach($user as $user)

  <tr>
  @method('PUT')
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>@if($user->autorizado == 'S')Sim @else Não @endif</td>
      <td>@if($user->tipo == 1)Gestor @else Analista @endif</td>
      <td>
        <a href="{{url("requisitos/gestaousuario/autorizar/$user->id")}}">
          <button class="btn btn-success"> Autorizar </button>
        </a>
        <a href="{{url("requisitos/gestaousuario/cancelar/$user->id")}}">
          <button class="btn btn-danger"> Desautorizar </button>
        </a>
        <a href="{{url("requisitos/gestaousuario/tornaradm/$user->id")}}">
          <button class="btn btn-success"> Tornar ADM </button>
        </a>
        <a href="{{url("requisitos/gestaousuario/removeradm/$user->id")}}">
          <button class="btn btn-danger"> Remover ADM </button>
        </a>

      </td>
  </tr>
 

@endforeach

  </tbody>
</table>


</div>


@endsection