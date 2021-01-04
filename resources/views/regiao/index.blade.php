@extends('layouts.layout')

@section('title', 'PTT - Regiões')

@section('content')
	<div class="conteudo-cabeca">
		<h1 class="titulo-site">Região</h1>
		<a href="/pttgcc/regiao/create" class="botao-enviar">Novo</a>
	</div>
	<div class="lista-semborda">
		@if ($regioes->isEmpty())
		<div class="">
			<p>Não há nenhuma região</p>
		</div>
		@else
		<div class="lista-item-dominio-borda">
			@foreach ($regioes as $regiao)
			<div class="item-dominio">
				<p>{{$regiao->reg_nome}}</p>
				<div class="acoes-item">
					@if (!$regiao->reg_deletado_em)
					<a href="/pttgcc/regiao/{{$regiao->reg_id}}/delete" title="Inativar"><span class="fas fa-trash-alt"></span></a>
					@else
					<span class="far fa-eye-slash" title="Regiao inativada"></span>
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
