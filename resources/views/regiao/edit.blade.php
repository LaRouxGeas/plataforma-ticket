@extends('layouts.layout')

@section('title', 'PTT - Regiões - Editar')

@section('content')
	<h1 class="titulo-site">Região </h1>
	<form class="" method="POST" action="/pttgcc/regiao/{{$regiao->reg_id}}">
		{{ method_field('PATCH') }}
		{{ csrf_field() }}

		<div class="campo-form">
			<h3 class="lista-descricao">Nome</h3>
			<input type="text" name="reg_nome" class="input {{$errors->has('reg_nome') ? 'erro-input' : ''}}" placeholder="Nome" value="{{$regiao->reg_nome}}">
		</div>

		<div class="campo-form">
			<h3 class="lista-descricao">Descrição</h3>
			<textarea name="reg_descricao" class="textarea {{$errors->has('reg_descricao') ? 'erro-input' : ''}}" placeholder="Descrição">{{$regiao->reg_descricao}}</textarea>
		</div>

		<div class="campo-form">
			<div class="lista-botoes">
				<input type="submit" class="botao-enviar" value="Atualizar">
			</div>
		</div>
	</form>
@endsection

@section('sidebar')
@endsection
