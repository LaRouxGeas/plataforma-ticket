@extends('layouts.layout')

@section('title', 'PTT - Regiões - Nova')

@section('content')
	<h1 class="titulo-site">Nova região</h1>
	<form class="" method="POST" action="/pttgcc/regiao">
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input id="nome" type="text" name="reg_nome" class="input {{$errors->has('reg_nome') ? 'erro-input' : ''}}" placeholder="Nome" value="{{old('reg_nome')}}">
			@if ($errors->has('reg_nome'))
				<p id="nome-erro" class="erro-descricao">{{$errors->first('reg_nome')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea id="descricao" name="reg_descricao" class="textarea {{$errors->has('reg_descricao') ? 'erro-input' : ''}}" placeholder="Descrição">{{old('reg_descricao')}}</textarea>
			@if ($errors->has('reg_descricao'))
				<p id="descricao-erro" class="erro-descricao">{{$errors->first('reg_descricao')}}</p>
			@endif
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<a href="/pttgcc/regiao" class="botao-enviar">Cancelar</a>
				<input type="submit" class="botao-enviar" value="Criar região">
			</div>
		</div>
	</form>
@endsection
