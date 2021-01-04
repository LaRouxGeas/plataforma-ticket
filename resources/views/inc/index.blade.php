@extends('layouts.layout')

@section('title', 'PTT - Pagina Inicial')

@section('content')
	<h1 class="titulo-site">Home</h1>
	<div class="lista-semborda">

		
	</div>
@endsection

@section('sidebar')
	@parent
	<p>Isso é outra parte da barra lateral</p>
@endsection