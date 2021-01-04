@extends('layouts.layout')

@section('title', 'PTT - Ticket '.$ticket->tic_id.' - Continuar')

@section('content')
	<div id="idFundoJanela"></div>
	<h1 class="titulo-site">Ticket n. {{$ticket->tic_id}}</h1>
	<form class="" method="POST" action="/pttgcc/ticket/{{$ticket->tic_id}}">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}

		<div class="campo-form">
			@include('inc.errors')
		</div>

		<div class="campo-form campo-divisao">
			<div class="campo-divisao-75">
				<h3 class="lista-descricao">Título</h3>
				<input id="titulo" type="text" name="tic_titulo" class="input {{$errors->has('tic_titulo') ? 'erro-input' : ''}}" value="{{old('tic_titulo',$ticket->tic_titulo)}}">
				@if ($errors->has('tic_titulo'))
					<p id="titulo-erro" class="erro-descricao">{{$errors->first('tic_titulo')}}</p>
				@endif
			</div>

			<div class="campo-divisao-25 campo-data">
				<h3 class="lista-descricao">Prazo de Aprovação</h3>
				<input id="datapicker" type="text" name="tic_validade" readonly class="input {{$errors->has('tic_validade') ? 'erro-input' : ''}}"
				value="{{ old('tic_validade', date('d/m/Y', strtotime($ticket->tic_validade))) }}" >
				@if ($errors->has('tic_validade'))
					<p id="datapicker-erro" class="erro-descricao">{{$errors->first('tic_validade')}}</p>
				@endif
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea id="descricaoTicket" name="tic_descricao" class="textarea {{$errors->has('tic_descricao') ? 'erro-input' : ''}}">{{old('tic_descricao',$ticket->tic_descricao)}}</textarea>
			@if ($errors->has('tic_descricao'))
				<p id="descricaoTicket-erro" class="erro-descricao">{{$errors->first('tic_descricao')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Arquivos</h3>
			<div id="DeDArquivos" class="arquivos-deposito">
				@foreach ($ticket->arquivos as $arquivo)
				<div id="containerArquivo" class="t-arquivo-item" title="{{$arquivo->arq_nome}}" data-id="{{$arquivo->arq_id}}">
					<span class="t-arquivo-imagem {{icone($arquivo->arq_extensao)}}"></span>
					<label class="t-arquivo-nome">{{reduzir_nome($arquivo->arq_nome)}}</label>
					<div class="t-arquivo-acoes">
						<span id="deletarArquivo" class="fas fa-times-circle t-arquivo-fechar"></span>
						<span id="visualizarArquivo" class="fas fa-info-circle t-arquivo-visualizar" data-ext="{{$arquivo->arq_extensao}}" data-mime="{{$arquivo->arq_mime}}" data-local="{{Storage::url($arquivo->arq_local)}}"></span>
						<a id="downloadArquivo" href="/pttgcc/arquivo/{{$arquivo->arq_id}}/download" target="_blank" class="fas fa-arrow-alt-circle-down t-arquivo-baixar"></a>
					</div>
				</div>
				@endforeach
				@foreach ($temporarios as $arquivo)
				<div id="containerArquivo" class="t-temporario-item" title="{{$arquivo->arq_nome}}" data-id="{{$arquivo->arq_id}}">
					<span class="t-arquivo-imagem {{icone($arquivo->arq_extensao)}}"></span>
					<label class="t-arquivo-nome">{{reduzir_nome($arquivo->arq_nome)}}</label>
					<div class="t-arquivo-acoes">
						<span id="deletarArquivo" class="fas fa-times-circle t-arquivo-fechar"></span>
						<span id="visualizarArquivo" class="fas fa-info-circle t-arquivo-visualizar" data-ext="{{$arquivo->arq_extensao}}" data-mime="{{$arquivo->arq_mime}}" data-local="{{Storage::url($arquivo->arq_local)}}"></span>
						<a id="downloadArquivo" href="/pttgcc/arquivo/{{$arquivo->arq_id}}/download" target="_blank" class="fas fa-arrow-alt-circle-down t-arquivo-baixar"></a>
					</div>
				</div>
				@endforeach
			</div>
			<input type="file" name="arquivo" id="uploadArquivo" class="input-hidden" multiple>
			<div id="DeDCampo" class="{{$errors->has('arquivo') ? 'erro-div' : ''}}"></div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Meio de Comunicação</h3>
			<div id="comunicacaoTicket" class="lista-itens-coluna {{$errors->has('comunicacoes') ? 'erro-div' : ''}}">
				@foreach ($comunicacoes as $i => $comunicacao)
				<div class="checkbox-opcao">
					<input id="checkCom{{$comunicacao->com_id}}" type="checkbox" name="comunicacoes[{{$comunicacao->com_id}}]" class="input-hidden" value="{{$comunicacao->com_id}}"
						{{ old('comunicacoes.'.$comunicacao->com_id, $comunicacao->tickets->find($ticket)) ? 'checked' : '' }}
					>
					<label for="checkCom{{$comunicacao->com_id}}" id="visualCheckboxCom{{$comunicacao->com_id}}" class="check-visual"></label>
					<label for="checkCom{{$comunicacao->com_id}}" id="descricaoCheckboxCom{{$comunicacao->com_id}}" class="check-descricao">{{$comunicacao->com_nome}}</label>
				</div>
				@endforeach
			</div>
			@if ($errors->has('comunicacoes'))
				<p id="comunicacaoTicket-erro" class="erro-descricao">{{$errors->first('comunicacoes')}}</p>
			@endif
			<div class="campo-form">
				<button id="outros" class="botao-enviar" type="button" data-nome="comunicacoes" data-name="comunicacoes" data-rota="comunicacao" data-pre="com" data-nomecampo="Meio de comunicação">Outros</button>
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Empresa</h3>
			<div id="empresaTicket" class="lista-itens-coluna {{$errors->has('empresas') ? 'erro-div' : ''}}">
				@foreach ($empresas as $i => $empresa)
				<div class="checkbox-opcao">
					<input id="checkEmp{{$empresa->emp_id}}" type="checkbox" name="empresas[{{$empresa->emp_id}}]" class="input-hidden" value="{{$empresa->emp_id}}"
						{{ old('empresas.'.$empresa->emp_id, $empresa->tickets->find($ticket)) ? 'checked' : '' }}
					>
					<label for="checkEmp{{$empresa->emp_id}}" id="visualCheckboxEmp{{$empresa->emp_id}}" class="check-visual"></label>
					<label for="checkEmp{{$empresa->emp_id}}" id="descricaoCheckboxEmp{{$empresa->emp_id}}" class="check-descricao">{{$empresa->emp_nome}}</label>
				</div>
				@endforeach
			</div>
			@if ($errors->has('empresas'))
				<p id="empresaTicket-erro" class="erro-descricao">{{$errors->first('empresas')}}</p>
			@endif
			<div class="campo-form">
				<button id="outros" class="botao-enviar" type="button" data-nome="empresas" data-rota="empresa" data-pre="emp" data-nomecampo="Empresa">Outros</button>
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Região</h3>
			<div id="regiaoTicket" class="lista-itens-coluna {{$errors->has('regioes') ? 'erro-div' : ''}}">
				@foreach ($regioes as $i => $regiao)
				<div class="checkbox-opcao">
					<input id="checkReg{{$regiao->reg_id}}" type="checkbox" name="regioes[{{$regiao->reg_id}}]" class="input-hidden" value="{{$regiao->reg_id}}"
						{{ old('regioes.'.$regiao->reg_id, $regiao->tickets->find($ticket)) ? 'checked' : '' }}
					>
					<label for="checkReg{{$regiao->reg_id}}" id="visualCheckboxReg{{$regiao->reg_id}}" class="check-visual"></label>
					<label for="checkReg{{$regiao->reg_id}}" id="descricaoCheckboxReg{{$regiao->reg_id}}" class="check-descricao">{{$regiao->reg_nome}}</label>
				</div>
				@endforeach
			</div>
			@if ($errors->has('regioes'))
				<p id="regiaoTicket-erro" class="erro-descricao">{{$errors->first('regioes')}}</p>
			@endif
			<div class="campo-form">
				<button id="outros" class="botao-enviar" type="button" data-nome="regioes" data-rota="regiao" data-pre="reg" data-nomecampo="Região">Outros</button>
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Produto</h3>
			<div id="produtoTicket" class="lista-itens-coluna {{$errors->has('produtos') ? 'erro-div' : ''}}">
				@foreach ($produtos as $i => $produto)
				<div class="checkbox-opcao">
					<input id="checkPro{{$produto->pro_id}}" type="checkbox" name="produtos[{{$produto->pro_id}}]" class="input-hidden" value="{{$produto->pro_id}}"
						{{ old('produtos.'.$produto->pro_id, $produto->tickets->find($ticket)) ? 'checked' : '' }}
					>
					<label for="checkPro{{$produto->pro_id}}" id="visualCheckboxPro{{$produto->pro_id}}" class="check-visual"></label>
					<label for="checkPro{{$produto->pro_id}}" id="descricaoCheckboxPro{{$produto->pro_id}}" class="check-descricao">{{$produto->pro_nome}}</label>
				</div>
				@endforeach
			</div>
			@if ($errors->has('produtos'))
				<p id="produtoTicket-erro" class="erro-descricao">{{$errors->first('produtos')}}</p>
			@endif
			<div class="campo-form">
				<button id="outros" class="botao-enviar" type="button" data-nome="produtos" data-rota="produto" data-pre="pro" data-nomecampo="Produto">Outros</button>
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Público Alvo</h3>
			<div id="publico_alvoTicket" class="lista-itens-coluna {{$errors->has('publicosAlvos') ? 'erro-div' : ''}}">
				@foreach ($publicosAlvos as  $publicoAlvo)
				<div class="checkbox-opcao">
					<input id="checkPua{{$publicoAlvo->pua_id}}" type="checkbox" name="publicosAlvos[{{$publicoAlvo->pua_id}}]" class="input-hidden" value="{{$publicoAlvo->pua_id}}"
						{{ old('publicosAlvos.'.$publicoAlvo->pua_id, $publicoAlvo->tickets->find($ticket)) ? 'checked' : '' }}
					>
					<label for="checkPua{{$publicoAlvo->pua_id}}" id="visualCheckboxPua{{$publicoAlvo->pua_id}}" class="check-visual"></label>
					<label for="checkPua{{$publicoAlvo->pua_id}}" id="descricaoCheckboxPua{{$publicoAlvo->pua_id}}" class="check-descricao">{{$publicoAlvo->pua_nome}}</label>
				</div>
				@endforeach
			</div>
			@if ($errors->has('publicosAlvos'))
				<p id="publico_alvoTicket-erro" class="erro-descricao">{{$errors->first('publicosAlvos')}}</p>
			@endif
			<div class="campo-form">
				<button id="outros" class="botao-enviar" type="button" data-nome="publicosAlvos" data-rota="publico_alvo" data-pre="pua" data-nomecampo="Público alvo">Outros</button>
			</div>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Aprovador</h3>
			<div id="aprovadorTicket" class="lista-itens {{$errors->has('fk_aprovador') ? 'erro-div' : ''}}">
				@foreach ($aprovadores as $aprovador)
				<div class="checkbox-opcao">
					@if ($ticket->aprovador)
					<input id="radioApr{{$aprovador->id}}" type="radio" name="fk_aprovador" class="input-hidden" value="{{$aprovador->id}}"
						{{ old('fk_aprovador', $ticket->aprovador->id) == $aprovador->id ? 'checked' : '' }}
					>
					@else
					<input id="radioApr{{$aprovador->id}}" type="radio" name="fk_aprovador" class="input-hidden" value="{{$aprovador->id}}"
						{{ old('fk_aprovador') == $aprovador->id ? 'checked' : '' }}
					>
					@endif
					<label for="radioApr{{$aprovador->id}}" id="visualRadioApr{{$aprovador->id}}" class="radio-visual"></label>
					<label for="radioApr{{$aprovador->id}}" id="descricaoRadioApr{{$aprovador->id}}" class="radio-descricao">{{$aprovador->name}}</label>
				</div>
				@endforeach
			</div>
			@if ($errors->has('fk_aprovador'))
				<p id="aprovadorTicket-erro" class="erro-descricao">{{$errors->first('fk_aprovador')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Observação Solicitante</h3>
			<textarea id="comentarioSolicitante" name="tic_obs_solicitante" class="textarea {{$errors->has('tic_obs_solicitante')?'erro-input':''}}">{{old('tic_obs_solicitante', $ticket->tic_observacao_solicitante)}}</textarea>
			@if ($errors->has('tic_obs_solicitante'))
				<p id="comentarioSolicitante-erro" class="erro-descricao">{{$errors->first('tic_obs_solicitante')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Observação Aprovador</h3>
			<textarea name="tic_obs_aprovador" class="textarea" disabled>{{$ticket->tic_observacao_aprovador}}</textarea>
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/ticket" class="botao-enviar">Voltar</a>
				@if ($ticket->tic_fk_estado != 6)
					<input type="submit" class="botao-enviar" name="enviar" value="Cancelar ticket">
				@endif
				<input type="submit" class="botao-enviar" name="enviar" value="Salvar rascunho">
				<input type="submit" class="botao-enviar" name="enviar" value="Enviar ticket">
			</div>
		</div>
	</form>
@endsection

@section('sidebar')
@endsection
