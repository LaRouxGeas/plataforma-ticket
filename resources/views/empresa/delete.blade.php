@extends('layouts.layout')

@section('title', 'PTT - Empresa - Inativar')

@section('content')
	<h1 class="titulo-site">Inativar empresa</h1>
	<form class="" method="POST" action="/pttgcc/empresa/{{$empresa->emp_id}}">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="atencao">Atenção! Se a empresa for inativada, não será mais possível usa-la! O histórico será mantido.</h3>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input type="text" name="emp_nome" class="input" value="{{$empresa->emp_nome}}" disabled>
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea name="emp_descricao" class="textarea" disabled>{{$empresa->emp_descricao}}</textarea>
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/empresa" class="botao-enviar">Cancelar</a>
				<input type="submit" class="botao-enviar" value="Inativar">
			</div>
		</div>
	</form>
@endsection
