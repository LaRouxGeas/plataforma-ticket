@extends('layouts.layout')

@section('title', 'PTT - Meios de Comunicações')

@section('content')
	<div class="conteudo-cabeca">
		<h1 class="titulo-site">Meio de comunicação</h1>
		<a href="/pttgcc/comunicacao/create" class="botao-enviar">Novo</a>
	</div>
	<div class="lista-semborda">
		@if ($comunicacoes->isEmpty())
		<div class="">
			<p>Não há nenhum meio de comunicacão</p>
		</div>
		@else
		<div class="lista-item-dominio-borda">
			@foreach ($comunicacoes as $comunicacao)
			<div class="item-dominio">
				<p>{{$comunicacao->com_nome}}</p>
				<div class="acoes-item">
					@if (!$comunicacao->com_deletado_em)
					<a href="/pttgcc/comunicacao/{{$comunicacao->com_id}}/delete" title="Inativar"><span class="icone-acao fas fa-trash-alt"></span></a>
					@else
					<span class="far fa-eye-slash" title="Comunicação inativada"></span>
					@endif
				</div>
			</div>
			@endforeach
		</div>
		@endif
	</div>
	<div class="campo-form">
		<div class="lista-botoes">
			<a href="/pttgcc/ticket" class="botao-enviar">Voltar</a>
		</div>
	</div>
@endsection
