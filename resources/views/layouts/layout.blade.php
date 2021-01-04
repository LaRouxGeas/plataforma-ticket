<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title', 'PTT')</title>
	<script type="text/javascript" src="{{ URL::to('js/jquery-3.3.1.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::to('bibliotecas/fontawesome/css/all.css') }}">

	<script type="text/javascript" src="{{ URL::to('js/script.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('js/data.js') }}"></script>
	<script> var idUser = {{auth()->id()}}</script>
	<link rel="stylesheet" type="text/css" href="{{ URL::to('css/estilo.css') }}">
</head>
<body>
	@include('inc.menu')

	<div class="site">
		@yield('content')
	</div>

	<footer class="rotape">

	</footer>
</body>
</html>
