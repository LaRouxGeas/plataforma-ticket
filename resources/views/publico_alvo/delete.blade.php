@extends('layouts.layout')

@section('title', 'PTT - Público Alvo - Inativar')

@section('content')
	<h1 class="titulo-site">Inativar público alvo</h1>
	<form class="" method="POST" action="/pttgcc/publico_alvo/{{$publico_alvo->pua_id}}">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="atencao">Atenção! Se o público alvo for inativado, não será mais possível usa-lo! O histórico será mantido.</h3>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input type="text" name="pua_nome" class="input" value="{{$publico_alvo->pua_nome}}" disabled>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea name="pua_descricao" class="textarea" disabled>{{$publico_alvo->pua_descricao}}</textarea>
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/publico_alvo" class="botao-enviar">Cancelar</a>
				<input type="submit" class="botao-enviar" value="Inativar">
			</div>
		</div>
	</form>
@endsection
