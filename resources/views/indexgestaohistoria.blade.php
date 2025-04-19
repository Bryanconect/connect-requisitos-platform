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

<h1 class="text-center">Gerenciar Histórias</h1>

<div class="col-8 m-auto"> 
    @csrf
    <table class="table text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Requisito</th>
                <th scope="col">Responsável</th>
                <th scope="col">Necessidade</th>
                <th scope="col">Status</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historias as $historias)
            @php
            $user = $historias->find($historias->id)->relUsers;
            $requisito = $historias->find($historias->id)->relRequisito;
            $elicitacao = $historias->find($historias->id)->relElicitacao;
            @endphp
            <tr>
                @if ($historias->status == 'Aberto' || $historias->status == 'Em Progresso')
                <th scope="row">{{$historias->id}}</th>
                <td>{{$requisito->programa}}</td>
                <td>{{$user->name}}</td>
                <td>{{$historias->necessidade}}</td>
                <td>{{$historias->status}}</td>
                <td>
                    <a href="{{url("requisitos/gestaohistoria/editarhistoria/$historias->id")}}">
                        <button class="btn btn-success"> Editar </button>
                    </a>


                    @if ($historias->status != 'Concluida')
                    <a href="{{url("/gestaohistoria/consultarinsights/$historias->id")}}">
                    <button class="btn btn-info btn-insights" data-historia-id="{{ $historias->id }}"> 
                    Gerar Insights 
                     </button>
                    </a>
                    @endif


                    <a href="{{url("requisitos/gestaohistoria/homologarhistoria/$historias->id")}}">
                        <button class="btn btn-primary"> Homologar </button>
                    </a>
                    <a href="{{url("requisitos/gestaohistoria/cancelarhistoria/$historias->id")}}">
                        <button class="btn btn-danger"> Cancelar </button>
                    </a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

