@extends('layouts.layout')

@section('title', 'PTT - Pequisar Tickets')

@section('content')
	<div class="conteudo-cabeca">
		<h1 class="titulo-site">Pesquisar tickets</h1>
		<a href="/pttgcc/ticket/create" class="botao-enviar" title="Novo ticket">Novo</a>
	</div>
	<h2 class="lista-descricao">Pesquisa</h2>
	<div class="lista-borda">
		<div class="lista-pesquisa" id="campoPesquisaTicket">
			<button id="botaoPesquisaId" class="botao-enviar">Protocolo</button>
			<button id="botaoPesquisaTitulo" class="botao-enviar">Título</button>
			@funcao('Aprovador PTTGCC  (Função Funcionário Interno GCC)')
			<button id="botaoPesquisaSolicitante" class="botao-enviar">Solicitante</button>
			@endfuncao
			<button id="botaoPesquisaAprovador" class="botao-enviar">Aprovador</button>
			<button id="botaoPesquisaDataCriacao" class="botao-enviar">Data da criação</button>
			<button id="botaoPesquisaStatus" class="botao-enviar">Status</button>
			<button id="botaoPesquisaAnexos" class="botao-enviar">Anexos</button>
		</div>
		<div class="campos-pesquisa" id="campoPesquisa"></div>
	</div>
	<h2 class="lista-descricao">Tickets</h2>
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
		<div id="solicitacoes" data-pagina="pesquisa"></div>
		<div class="paginas" id="paginas"></div>
	</div>
@endsection
