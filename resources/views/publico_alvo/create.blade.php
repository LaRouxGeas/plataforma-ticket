@extends('layouts.layout')

@section('title', 'PTT - Público Alvo - Novo Público Alvo')

@section('content')
	<h1 class="titulo-site">Novo público alvo</h1>
	<form class="" method="POST" action="/pttgcc/publico_alvo">
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input id="nome" type="text" name="pua_nome" class="input {{$errors->has('pua_nome') ? 'erro-input' : ''}}" value="{{old('pua_nome')}}" placeholder="Nome">
			@if ($errors->has('pua_nome'))
				<p id="nome-erro" class="erro-descricao">{{$errors->first('pua_nome')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea id="descricao" name="pua_descricao" class="textarea {{$errors->has('pua_descricao') ? 'erro-input' : ''}}" placeholder="Descrição">{{old('pua_descricao')}}</textarea>
			@if ($errors->has('pua_descricao'))
				<p id="descricao-erro" class="erro-descricao">{{$errors->first('pua_descricao')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/publico_alvo" class="botao-enviar">Cancelar</a>
				<input type="submit" class="botao-enviar" value="Criar público alvo">
			</div>
		</div>
	</form>
@endsection
