@extends('layouts.layout')

@section('title', 'PTT - Comunicação')

@section('content')
	<div class="conteudo-cabeca">
		<h1 class="titulo-site">Comunicação: {{$comunicacao->com_nome}}</h1>
	</div>
	<div class="">
		<h3 class="lista-descricao">Descrição</h3>
		<p>{{$comunicacao->com_nome}}</p>
	</div>
@endsection

@section('sidebar')
@endsection