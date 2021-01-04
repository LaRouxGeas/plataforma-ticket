@extends('layouts.layout')

@section('title', 'PTT - Região')

@section('content')
	<div class="conteudo-cabeca">
		<h1 class="titulo-site">Região</h1>
	</div>

	<div class="campo-form">
		<h3 class="lista-descricao">Nome</h3>
		<h4>{{$regiao->reg_nome}}</h4>
	</div>

	<div class="campo-form">
		<h3 class="lista-descricao">Descrição</h3>
		<p>{{$regiao->reg_descricao}}</p>
	</div>

	<div class="campo-form">
		<h3 class="lista-descricao">Criada em</h3>
		<h4>{{date('d/m/Y', strtotime($regiao->reg_criado_em))}}</p>
	</div>
@endsection

@section('sidebar')
@endsection