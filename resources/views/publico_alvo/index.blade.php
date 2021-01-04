@extends('layouts.layout')

@section('title', 'PTT - Públicos Alvos')

@section('content')
	<div class="conteudo-cabeca">
		<h1 class="titulo-site">Públicos alvos</h1>
		<a href="/pttgcc/publico_alvo/create" class="botao-enviar">Novo</a>
	</div>
	<div class="lista-semborda">
		@if ($publicos_alvos->isEmpty())
		<div>
			<p>Não há nenhum público alvo</p>
		</div>
		@else
		<div class="lista-item-dominio-borda">
			@foreach ($publicos_alvos as $publicoAlvo)
			<div class="item-dominio">
				<p>{{$publicoAlvo->pua_nome}}</p>
				<div class="acoes-item">
					@if (!$publicoAlvo->pua_deletado_em)
					<a href="/pttgcc/publico_alvo/{{$publicoAlvo->pua_id}}/delete" title="Inativar"><span class="icone-acao fas fa-trash-alt"></span></a>
					@else
					<span class="far fa-eye-slash" title="Público alvo inativado"></span>
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

@section('sidebar')
@endsection
