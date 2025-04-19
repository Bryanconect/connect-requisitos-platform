@extends('templates.template')

@section('content')

<div class="text-center mt-3 mb-4">

<a href="{{url("elicitacao/inicio")}}">
        <button class="btn btn-danger")> Voltar </button>
        </a>
     
</div>

<h1 class="text-center">Cadastrar Elicitação</h1>

<div class="col-8 m-auto"> 
    @if(isset($errors) && count($errors)>0)
    <div class="text-center mt-4 mb-4 p-2 alert-danger">
        @foreach($errors->all() as $erro)
            {{$erro}}<br>
        @endforeach
    </div>
    @endif


<form name="formCad" id="formCad" method="post" enctype="multipart/form-data" action="{{url("elicitacao")}}"> 


@csrf
<label>Titulo: </label>
<input class="form-control" type="text" maxLength="100" name="titulo" id="titulo" placeholder="Digite o titulo" required>
<label>Tipo: </label>
<select class="form-control" name="tipo" id="tipo"> 
<option value="Entrevista" name="tipo" id="tipo"> Entrevista </option>
<option value="Questionario" name="tipo" id="tipo"> Questionario </option>
<option value="Observacao" name="tipo" id="tipo"> Observacao </option>
<option value="Etnografia" name="tipo" id="tipo"> Etnografia </option>
<option value="Workshop" name="tipo" id="tipo"> Workshop </option>
<option value="Brainstorm" name="tipo" id="tipo"> Brainstorm </option>
</select>
 
<label>Setor Envolvido: </label>
<select class="form-control" name="setor_envolvido" id="setor_envolvido"> 
<option value="Contabilidade" name="setor_envolvido" id="setor_envolvido"> Contabilidade </option>
<option value="Suprimentos" name="setor_envolvido" id="setor_envolvido"> Suprimentos </option>
<option value="Fiscal" name="setor_envolvido" id="setor_envolvido"> Fiscal </option>
<option value="Financeiro" name="setor_envolvido" id="setor_envolvido"> Financeiro </option>
<option value="Almoxarifado" name="setor_envolvido" id="setor_envolvido"> Almoxarifado </option>
<option value="Operacional" name="setor_envolvido" id="setor_envolvido"> Operacional </option>
</select>

<label>Data: </label>
<input class="form-control" type="date" name="data_reuniao" id="data_reuniao" placeholder="" required>
@if (auth()->check())
<label>Usuário: </label>
<select class="form-control" value= "{{ auth()->user()->id }}" name="id_user" id="id_user"> 
<option value="{{ auth()->user()->id }}" name="id_user" id="id_user"> {{ auth()->user()->name }} </option>
</select>
@else
@endif
<label>Conteudo: </label>
<textarea class="form-control" type="textarea" maxLength="250" name="conteudo" id="conteudo" placeholder="" rows="4" cols="50" required>
</textarea>
<label>Anexo Imagem: </label>
<input class="form-control" name="imagem" id="imagem" accept="image/*" type="file"/>

<input class="btn btn-primary" type="submit">


</form>

</div>


@endsection