@extends('layouts.layout')

@section('title', 'PTT - Comunicação -  Novo Meio de Comunicação')

@section('content')
	<h1 class="titulo-site">Novo meio de comunicação</h1>
	<form class="" method="POST" action="/pttgcc/comunicacao">
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input id="nome" type="text" name="com_nome" class="input {{$errors->has('com_nome') ? 'erro-input' : ''}}" value="{{old('com_nome')}}" placeholder="Nome">
			@if ($errors->has('com_nome'))
				<p id="nome-erro" class="erro-descricao">{{$errors->first('com_nome')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea id="descricao" name="com_descricao" class="textarea {{$errors->has('com_descricao') ? 'erro-input' : ''}}" placeholder="Descrição">{{old('com_descricao')}}</textarea>
			@if ($errors->has('com_descricao'))
				<p id="descricao-erro" class="erro-descricao">{{$errors->first('com_descricao')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/comunicacao" class="botao-enviar">Cancelar</a>
				<input type="submit" class="botao-enviar" value="Criar meio de comunicação">
			</div>
		</div>
	</form>
@endsection
