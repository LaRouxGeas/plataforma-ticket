@extends('layouts.layout')

@section('title', 'PTT - Tickets')

@section('content')
	<div class="conteudo-cabeca">
		<h1 class="titulo-site">Tickets</h1>
		<a href="/pttgcc/ticket/create" class="botao-enviar" title="Novo ticket">Novo</a>
	</div>
	<div class="lista-borda">
		<div class="ticket-tabela ticket-cabecalho">
			<span class="ticket-item">Protocolo</span>
			<span class="ticket-item">Título</span>
			<span class="ticket-item">Nome do solicitante</span>
			<span class="ticket-item">Nome do aprovador</span>
			<span class="ticket-item">Data da criação</span>
			<span class="ticket-item">Status</span>
			<span class="ticket-item fas fa-copy" title="Anexos"></span>
		</div>
		<div id="solicitacoes" data-pagina="seus"></div>
		<div class="paginas" id="paginas"></div>
	</div>
@endsection
