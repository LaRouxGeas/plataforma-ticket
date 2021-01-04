@extends('layouts.layout')

@section('title', 'PTT - Produtos')

@section('content')
	<div class="conteudo-cabeca">
		<h1 class="titulo-site">Produtos</h1>
		<a href="/pttgcc/produto/create" class="botao-enviar">Novo</a>
	</div>
	<div class="lista-semborda">
		@if ($produtos->isEmpty())
		<div>
			<p>Não há nenhum produto</p>
		</div>
		@else
		<div class="lista-item-dominio-borda">
			@foreach ($produtos as $produto)
			<div class="item-dominio">
				<p>{{$produto->pro_nome}}</p>
				<div class="acoes-item">
					@if (!$produto->pro_deletado_em)
					<a href="/pttgcc/produto/{{$produto->pro_id}}/delete" title="Inativar"><span class="icone-acao fas fa-trash-alt"></span></a>
					@else
					<span class="far fa-eye-slash" title="Produto inativado"></span>
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
