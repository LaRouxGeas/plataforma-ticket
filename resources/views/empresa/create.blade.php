@extends('layouts.layout')

@section('title', 'PTT - Empresa -  Nova Empresa')

@section('content')
	<h1 class="titulo-site">Nova empresa</h1>
	<form class="" method="POST" action="/pttgcc/empresa">
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input id="nome" type="text" name="emp_nome" class="input {{$errors->has('emp_nome') ? 'erro-input' : ''}}" value="{{old('emp_nome')}}" placeholder="Nome">
			@if ($errors->has('emp_nome'))
				<p id="nome-erro" class="erro-descricao">{{$errors->first('emp_nome')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea id="descricao" name="emp_descricao" class="textarea {{$errors->has('emp_descricao') ? 'erro-input' : ''}}" placeholder="Descrição">{{old('emp_descricao')}}</textarea>
			@if ($errors->has('emp_descricao'))
				<p id="descricao-erro" class="erro-descricao">{{$errors->first('emp_descricao')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/empresa" class="botao-enviar">Cancelar</a>
				<input type="submit" class="botao-enviar" value="Criar empresa">
			</div>
		</div>
	</form>
@endsection
