@extends('layouts.layout')

@section('title', 'PTT - Meio de Comunicação - Inativar')

@section('content')
	<h1 class="titulo-site">Inativar meio de comunicação</h1>
	<form class="" method="POST" action="/pttgcc/comunicacao/{{$comunicacao->com_id}}">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="atencao">Atenção! Se o meio de comunicação for inativado, não será mais possível usa-lo! O histórico será mantido.</h3>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input type="text" name="com_nome" class="input" disabled placeholder="Nome" value="{{$comunicacao->com_nome}}">
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea name="com_descricao" class="textarea" disabled placeholder="Descrição">{{$comunicacao->com_descricao}}</textarea>
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/comunicacao" class="botao-enviar">Cancelar</a>
				<input type="submit" class="botao-enviar" value="Inativar">
			</div>
		</div>
	</form>
@endsection
