<html>
	<head>
		<style>
			h1,
			h2,
			h3,
			h4,
			h5,
			h6,
			a,
			p {
				font-family: Helvetica;
				margin: 0px;
			}

			.email-container {
				margin: 75px auto 0px;
				max-width: 750px;
			}

			.email-titulo {
				text-align: center;
				font-weight: normal;
				color: #660099;
			}

			.email-sub-titulo {
				margin: 5px 0px 25px;
				font-weight: normal;
				color: #660099;
			}

			.email-borda {
				margin: 10px 0px;
				padding: 15px;
				border: 2px solid #660099;
				border-radius: 10px;
				text-align: center;
			}

			.email-botao {
				display: block;
				border: 1px solid #609;
				padding: 10px 8px;
				margin: 0px auto;
				font-family: Raleway;
				color: #FFF;
				background-color: #609;
				font-size: 14px;
				border-radius: 5px;
				cursor: pointer;
			}

			.email-botao > a {
				color: #FFF;
				text-decoration: none;
			}

			.email-botao > a:hover, .email-botao > a:hover {
				text-decoration: none;
			}
		</style>
	</head>
	<body class="email-container">
		<h1 class="email-titulo">Bem vindo a Plataforma de Tickets - PTT!</h1>
		<div class="email-borda">
			<h3 class="email-sub-titulo">Olá {{$usuario->name}},</h3>
			<p>Você recebeu acesso a Plataforma de Tickts PTT da GCC D+ Qualidade!</p>
			<p>Aqui você podera fazer criar tickets para solicitar demandas na sua area,</p>
			<p>ou receber tickets aprovando ou não pedidos.</p>
			<br>
			<button class="email-botao"><a href="https://gcccontactcenter.com/">Click aqui para Acessar o Sistema!</a></button>
			<br>
			<button class="email-botao"><a href="https://gcccontactcenter.com.br/wp-content/uploads/2019/04/Plataforma-PTT-Tutorial.docx">Click aqui para baixar o Tutorial!</a></button>
			<br>
			<p>Att, PTT - GCC D+ Qualidade.</p>
		</div>
	</body>
</html>
