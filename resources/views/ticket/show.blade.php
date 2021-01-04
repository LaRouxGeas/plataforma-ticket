@extends('layouts.layout')

@section('title', 'PTT - Ticket '.$ticket->tic_id)

@section('content')
	<div id="idFundoJanela"></div>
	<h1 class="titulo-site">Ticket n. {{$ticket->tic_id}}</h1>
	<form class="" method="POST" action="/pttgcc/ticket/{{$ticket->tic_id}}/cancelar">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}

		<div class="campo-form">
		@if ($ticket->tic_fk_estado == 1 || $ticket->tic_fk_estado == 2)
			<h2 class="lista-descricao">Situação <span class="lista-autor">{{$ticket->estado->est_nome}}</span></h2>
		@elseif ($ticket->tic_fk_estado == 3)
			<h2 class="lista-descricao">Situação <span class="lista-autor-ea">{{$ticket->estado->est_nome}}</span></h2>
		@elseif ($ticket->tic_fk_estado == 4)
			<h2 class="lista-descricao">Situação <span class="lista-autor-a">{{$ticket->estado->est_nome}}</span></h2>
		@elseif ($ticket->tic_fk_estado == 5)
			<h2 class="lista-descricao">Situação <span class="lista-autor-na">{{$ticket->estado->est_nome}}</span></h2>
		@elseif ($ticket->tic_fk_estado == 6)
			<h2 class="lista-descricao">Situação <span class="lista-autor-c">{{$ticket->estado->est_nome}}</span></h2>
		@endif
		</div>

		<div class="campo-form">
			<h2 class="lista-descricao">Solicitante <span class="lista-autor">{{$ticket->autor->name}}</span></h2>
		</div>

		<div class="campo-form campo-divisao">
			<div class="campo-divisao-75">
				<h3 class="lista-descricao">Título</h3>
				<input type="text" name="tic_titulo" class="input" value="{{$ticket->tic_titulo}}" disabled>
			</div>
			<div class="campo-divisao-25 campo-data">
				<h3 class="lista-descricao">Prazo de Aprovação</h3>
				<input type="text" name="tic_validade" class="input" value="{{date('d/m/Y', strtotime($ticket->tic_validade))}}" disabled>
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea name="tic_descricao" class="textarea" disabled>{{$ticket->tic_descricao}}</textarea>
		</div>

		@if ($ticket->arquivos->count() > 0)
		<div class="campo-form">
			<h3 class="lista-descricao">Arquivos</h3>
			<div id="DeDArquivos" class="arquivos-deposito">
				@foreach ($ticket->arquivos as $arquivo)
				<div id="containerArquivo" class="t-arquivo-item" title="{{$arquivo->arq_nome}}" data-id="{{$arquivo->arq_id}}">
					<span class="t-arquivo-imagem {{icone($arquivo->arq_extensao)}}"></span>
					<label class="t-arquivo-nome">{{reduzir_nome($arquivo->arq_nome)}}</label>
					<div class="t-arquivo-acoes">
						<span id="visualizarArquivo" class="fas fa-info-circle t-arquivo-visualizar" data-ext="{{$arquivo->arq_extensao}}" data-mime="{{$arquivo->arq_mime}}" data-local="{{Storage::url($arquivo->arq_local)}}"></span>
						<a id="downloadArquivo" href="/pttgcc/arquivo/{{$arquivo->arq_id}}/download" target="_blank" class="fas fa-arrow-alt-circle-down t-arquivo-baixar"></a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		@endif

		<div class="campo-form">
			<h3 class="lista-descricao">Meio de Comunicação</h3>
			<div class="lista-itens-coluna">
				@foreach ($comunicacoes as $comunicacao)
				<div class="checkbox-opcao">
					<input id="CcheckCom{{$comunicacao->com_id}}" type="checkbox" name="comunicacoes[]" class="input-hidden" value="{{$comunicacao->com_id}}" {{$comunicacao->tickets->find($ticket)?'checked':''}}>
					<label id="CvisualCheckboxCom{{$comunicacao->com_id}}" class="check-visual-consulta"></label>
					<label class="check-descricao">{{$comunicacao->com_nome}}</label>
				</div>
				@endforeach
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Empresa</h3>
			<div class="lista-itens">
				@foreach ($empresas as $empresa)
				<div class="checkbox-opcao">
					<input id="CcheckEmp{{$empresa->emp_id}}" type="checkbox" name="empresas[]" class="input-hidden" value="{{$empresa->emp_id}}" {{$empresa->tickets->find($ticket)?'checked':''}}>
					<label id="CvisualCheckboxEmp{{$empresa->emp_id}}" class="check-visual-consulta"></label>
					<label class="check-descricao">{{$empresa->emp_nome}}</label>
				</div>
				@endforeach
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Região</h3>
			<div class="lista-itens">
				@foreach ($regioes as $regiao)
				<div class="checkbox-opcao">
					<input id="CcheckReg{{$regiao->reg_id}}" type="checkbox" name="regioes[]" class="input-hidden" value="{{$regiao->reg_id}}" {{$regiao->tickets->find($ticket)?'checked':''}}>
					<label id="CvisualCheckboxReg{{$regiao->reg_id}}" class="check-visual-consulta"></label>
					<label class="check-descricao">{{$regiao->reg_nome}}</label>
				</div>
				@endforeach
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Produto</h3>
			<div class="lista-itens">
				@foreach ($produtos as $produto)
				<div class="checkbox-opcao">
					<input id="CcheckPro{{$produto->pro_id}}" type="checkbox" name="produtos[]" class="input-hidden" value="{{$produto->pro_id}}" {{$produto->tickets->find($ticket)?'checked':''}}>
					<label id="CvisualCheckboxPro{{$produto->pro_id}}" class="check-visual-consulta"></label>
					<label class="check-descricao">{{$produto->pro_nome}}</label>
				</div>
				@endforeach
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Público Alvo</h3>
			<div class="lista-itens">
				@foreach ($publicosAlvos as $publicoAlvo)
				<div class="checkbox-opcao">
					<input id="CcheckPua{{$publicoAlvo->pua_id}}" type="checkbox" name="publicosAlvos[]" class="input-hidden" value="{{$publicoAlvo->pua_id}}" {{$publicoAlvo->tickets->find($ticket)?'checked':''}}>
					<label id="CvisualCheckboxPua{{$publicoAlvo->pua_id}}" class="check-visual-consulta"></label>
					<label class="check-descricao">{{$publicoAlvo->pua_nome}}</label>
				</div>
				@endforeach
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Aprovador</h3>
			<div class="lista-itens">
				@foreach ($aprovadores as $aprovador)
				<div class="checkbox-opcao">
					<input id="CRadioApr{{$aprovador->id}}" type="radio" name="fk_aprovador" class="input-hidden" value="{{$aprovador->id}}" {{$aprovador->ticketsAprovador->find($ticket)?'checked':''}}>
					<label id="CvisualRadioApr{{$aprovador->id}}" class="radio-visual-consulta"></label>
					<label class="radio-descricao">{{$aprovador->name}}</label>
				</div>
				@endforeach
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Observação Solicitante</h3>
			<textarea name="tic_obs_solicitante" class="textarea" disabled>{{$ticket->tic_observacao_solicitante}}</textarea>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Observação Aprovador</h3>
			<textarea name="tic_obs_aprovador" class="textarea" disabled>{{$ticket->tic_observacao_aprovador}}</textarea>
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/ticket" class="botao-enviar">Voltar</a>
				@if (($ticket->tic_fk_estado == 1 || $ticket->tic_fk_estado == 2) && $ticket->autor->id == auth()->id())
					<button id="cancelarTicketMensagem" type="button" class="botao-enviar">Cancelar Ticket</button>
				@endif
			</div>
		</div>
	</form>
@endsection

@section('sidebar')
@endsection
