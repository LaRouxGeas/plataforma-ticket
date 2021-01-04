@extends('layouts.layout')

@section('title', 'PTT - Empresas')

@section('content')
	<div class="conteudo-cabeca">
		<h1 class="titulo-site">Empresas</h1>
		<a href="/pttgcc/empresa/create" class="botao-enviar">Novo</a>
	</div>
	<div class="lista-semborda">
		@if ($empresas->isEmpty())
		<div>
			<p>Não há nenhuma empresa</p>
		</div>
		@else
		<div class="lista-item-dominio-borda">
			@foreach ($empresas as $empresa)
			<div class="item-dominio">
				<p>{{$empresa->emp_nome}}</p>
				<div class="acoes-item">
					@if (!$empresa->emp_deletado_em)
					<a href="/pttgcc/empresa/{{$empresa->emp_id}}/delete" title="Inativar"><span class="icone-acao fas fa-trash-alt"></span></a>
					@else
					<span class="far fa-eye-slash" title="Empresa inativada"></span>
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
