<div class="menu">
	<div class="menu-item-home">
		<img class="logo-pequena" src="{{asset('img/logo-branca.png')}}">
	</div>
	<div class="menu-item-home-branco">
		<img class="logo" src="{{asset('img/paccar.png')}}">
	</div>
	<div class="menu-item-container">
		<button id="menudrop2" class="menu-item-drop">Tickets</button>
		<div id="menulista2" class="menu-item-lista">
			<a class="menu-sub-item" href="/pttgcc/ticket/create">Cadastrar novo Ticket</a>
			<a class="menu-sub-item" href="/pttgcc/ticket/pesquisar">Pequisar Ticket cadastrado</a>
			<a class="menu-sub-item" href="/pttgcc/ticket">Seus Tickets</a>
		</div>
	</div>
	@funcao('Aprovador PTTGCC  (Função Funcionário Interno GCC)')
	<div class="menu-item-container">
		<button id="menudrop2" class="menu-item-drop">Cadastros</button>
		<div id="menulista2" class="menu-item-lista">
			<a class="menu-sub-item" href="/pttgcc/produto">Produto</a>
			<a class="menu-sub-item" href="/pttgcc/publico_alvo">Público Alvo</a>
			<a class="menu-sub-item" href="/pttgcc/empresa">Empresa</a>
			<a class="menu-sub-item" href="/pttgcc/regiao">Região</a>
			<a class="menu-sub-item" href="/pttgcc/comunicacao">Meio de Comunicação</a>
		</div>
	</div>
	@endfuncao
	<div class="menu-item-reverso">
		<button id="menudrop3" class="menu-usuario-drop">{{ Auth::user()->name }}</button>
		<div id="menulista3" class="menu-item-lista">
			<a class="menu-sub-usuario" href="/pttgcc/sair">
				<span class="sair-descricao">Sair</span>
				<span class="fas fa-sign-out-alt"></span>
			</a>
		</div>
	</div>
</div>
