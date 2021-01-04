@extends('layouts.layout')

@section('title', 'PTT - Produto - Inativar')

@section('content')
	<h1 class="titulo-site">Inativar produto</h1>
	<form class="" method="POST" action="/pttgcc/produto/{{$produto->pro_id}}">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="atencao">Atenção! Se o produto for inativado, não será mais possível usa-lo! O histórico será mantido.</h3>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input type="text" name="pro_nome" class="input" value="{{$produto->pro_nome}}" disabled>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea name="pro_descricao" class="textarea" disabled>{{$produto->pro_descricao}}</textarea>
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/produto" class="botao-enviar">Cancelar</a>
				<input type="submit" class="botao-enviar" value="Inativar">
			</div>
		</div>
	</form>
@endsection
