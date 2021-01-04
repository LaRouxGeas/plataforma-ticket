@extends('layouts.layout')

@section('title', 'PTT - Regiões - Inativar')

@section('content')
	<h1 class="titulo-site">Inativar região</h1>
	<form class="" method="POST" action="/pttgcc/regiao/{{$regiao->reg_id}}">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="atencao">Atenção! Se a região for inativada, não será mais possível usa-la! O histórico será mantido.</h3>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input type="text" name="reg_nome" class="input" disabled placeholder="Nome" value="{{$regiao->reg_nome}}">
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea name="reg_descricao" class="textarea" disabled placeholder="Descrição">{{$regiao->reg_descricao}}</textarea>
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/regiao" class="botao-enviar">Cancelar</a>
				<input type="submit" class="botao-enviar" value="Inativar">
			</div>
		</div>
	</form>
@endsection
