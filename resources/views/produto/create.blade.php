@extends('layouts.layout')

@section('title', 'PTT - Produto - Novo Produto')

@section('content')
	<h1 class="titulo-site">Novo produto</h1>
	<form class="" method="POST" action="/pttgcc/produto">
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input id="nome" type="text" name="pro_nome" class="input {{$errors->has('pro_nome') ? 'erro-input' : ''}}" value="{{old('pro_nome')}}" placeholder="Nome">
			@if ($errors->has('pro_nome'))
				<p id="nome-erro" class="erro-descricao">{{$errors->first('pro_nome')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea id="descricao" name="pro_descricao" class="textarea {{$errors->has('pro_descricao') ? 'erro-input' : ''}}" placeholder="Descrição">{{old('pro_descricao')}}</textarea>
			@if ($errors->has('pro_descricao'))
				<p id="descricao-erro" class="erro-descricao">{{$errors->first('pro_descricao')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/produto" class="botao-enviar">Cancelar</a>
				<input type="submit" class="botao-enviar" value="Criar produto">
			</div>
		</div>
	</form>
@endsection
