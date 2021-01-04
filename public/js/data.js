
	var mesExt = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
	var zeroN = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09"];

	function construirCalendario(idCampoData) {
		$("#"+idCampoData).after(
			$("<div>", {id:idCampoData+"idFundoDataP", class:"calendario-fundo"}).append(
				$("<div>", {class:"calendario"}).append(
					$("<div>", {class:"mes-ano"}).append(
						$("<span>", {id:idCampoData+"idSetaDataE", class:"fas fa-caret-left dtp-botao"}),
						$("<div>", {class:"data-selecao-mes-ano"}).append(
							$("<button>", {id:idCampoData+"idSelDataM", class:"data-selecao-mes", type:"button"}),
							$("<div>", {id:idCampoData+"idMesLista", class:"data-selecao-lista-mes"}),
							$("<label>", {class:"data-selecao-d"}).text("de"),
							$("<label>", {id:idCampoData+"idAno", class:"data-selecao-ano"})
						),
						$("<span>", {id:idCampoData+"idSetaDataD", class:"fas fa-caret-right dtp-botao"})
					),
					$("<div>", {class:"semana"}).append(
						$("<label>", {class:"dias-semanas", title:"Domingo"}).text("D"),
						$("<label>", {class:"dias-semanas", title:"Segunda"}).text("S"),
						$("<label>", {class:"dias-semanas", title:"Terça"}).text("T"),
						$("<label>", {class:"dias-semanas", title:"Quarta"}).text("Q"),
						$("<label>", {class:"dias-semanas", title:"Quinta"}).text("Q"),
						$("<label>", {class:"dias-semanas", title:"Sexta"}).text("S"),
						$("<label>", {class:"dias-semanas", title:"Sábado"}).text("S")
					),
					$("<div>", {class:"semana-linha"}).append(
						$("<button>", {id:idCampoData+"diaEspaco0", class:"dia-espaco", type:"button", value:0}),
						$("<button>", {id:idCampoData+"diaEspaco1", class:"dia-espaco", type:"button", value:1}),
						$("<button>", {id:idCampoData+"diaEspaco2", class:"dia-espaco", type:"button", value:2}),
						$("<button>", {id:idCampoData+"diaEspaco3", class:"dia-espaco", type:"button", value:3}),
						$("<button>", {id:idCampoData+"diaEspaco4", class:"dia-espaco", type:"button", value:4}),
						$("<button>", {id:idCampoData+"diaEspaco5", class:"dia-espaco", type:"button", value:5}),
						$("<button>", {id:idCampoData+"diaEspaco6", class:"dia-espaco", type:"button", value:6})
					),
					$("<div>", {class:"semana-linha"}).append(
						$("<button>", {id:idCampoData+"diaEspaco7", class:"dia-espaco", type:"button", value:7}),
						$("<button>", {id:idCampoData+"diaEspaco8", class:"dia-espaco", type:"button", value:8}),
						$("<button>", {id:idCampoData+"diaEspaco9", class:"dia-espaco", type:"button", value:9}),
						$("<button>", {id:idCampoData+"diaEspaco10", class:"dia-espaco", type:"button", value:10}),
						$("<button>", {id:idCampoData+"diaEspaco11", class:"dia-espaco", type:"button", value:11}),
						$("<button>", {id:idCampoData+"diaEspaco12", class:"dia-espaco", type:"button", value:12}),
						$("<button>", {id:idCampoData+"diaEspaco13", class:"dia-espaco", type:"button", value:13})
					),
					$("<div>", {class:"semana-linha"}).append(
						$("<button>", {id:idCampoData+"diaEspaco14", class:"dia-espaco", type:"button", value:14}),
						$("<button>", {id:idCampoData+"diaEspaco15", class:"dia-espaco", type:"button", value:15}),
						$("<button>", {id:idCampoData+"diaEspaco16", class:"dia-espaco", type:"button", value:16}),
						$("<button>", {id:idCampoData+"diaEspaco17", class:"dia-espaco", type:"button", value:17}),
						$("<button>", {id:idCampoData+"diaEspaco18", class:"dia-espaco", type:"button", value:18}),
						$("<button>", {id:idCampoData+"diaEspaco19", class:"dia-espaco", type:"button", value:19}),
						$("<button>", {id:idCampoData+"diaEspaco20", class:"dia-espaco", type:"button", value:20})
					),
					$("<div>", {class:"semana-linha"}).append(
						$("<button>", {id:idCampoData+"diaEspaco21", class:"dia-espaco", type:"button", value:21}),
						$("<button>", {id:idCampoData+"diaEspaco22", class:"dia-espaco", type:"button", value:22}),
						$("<button>", {id:idCampoData+"diaEspaco23", class:"dia-espaco", type:"button", value:23}),
						$("<button>", {id:idCampoData+"diaEspaco24", class:"dia-espaco", type:"button", value:24}),
						$("<button>", {id:idCampoData+"diaEspaco25", class:"dia-espaco", type:"button", value:25}),
						$("<button>", {id:idCampoData+"diaEspaco26", class:"dia-espaco", type:"button", value:26}),
						$("<button>", {id:idCampoData+"diaEspaco27", class:"dia-espaco", type:"button", value:27})
					),
					$("<div>", {class:"semana-linha"}).append(
						$("<button>", {id:idCampoData+"diaEspaco28", class:"dia-espaco", type:"button", value:28}),
						$("<button>", {id:idCampoData+"diaEspaco29", class:"dia-espaco", type:"button", value:29}),
						$("<button>", {id:idCampoData+"diaEspaco30", class:"dia-espaco", type:"button", value:30}),
						$("<button>", {id:idCampoData+"diaEspaco31", class:"dia-espaco", type:"button", value:31}),
						$("<button>", {id:idCampoData+"diaEspaco32", class:"dia-espaco", type:"button", value:32}),
						$("<button>", {id:idCampoData+"diaEspaco33", class:"dia-espaco", type:"button", value:33}),
						$("<button>", {id:idCampoData+"diaEspaco34", class:"dia-espaco", type:"button", value:34})
					),
					$("<div>", {class:"semana-linha"}).append(
						$("<button>", {id:idCampoData+"diaEspaco35", class:"dia-espaco", type:"button", value:35}),
						$("<button>", {id:idCampoData+"diaEspaco36", class:"dia-espaco", type:"button", value:36}),
						$("<button>", {id:idCampoData+"diaEspaco37", class:"dia-espaco", type:"button", value:37}),
						$("<button>", {id:idCampoData+"diaEspaco38", class:"dia-espaco", type:"button", value:38}),
						$("<button>", {id:idCampoData+"diaEspaco39", class:"dia-espaco", type:"button", value:39}),
						$("<button>", {id:idCampoData+"diaEspaco40", class:"dia-espaco", type:"button", value:40}),
						$("<button>", {id:idCampoData+"diaEspaco41", class:"dia-espaco", type:"button", value:41})
					),
				)
			)
		);
	}

	function alternarEstadoCalendario(idCampoData) {
		$("#"+idCampoData+"idFundoDataP").toggleClass("ativo").mouseleave(function () {
			$(this).removeClass("ativo")
		});
	}

	function iniciarCalendario(idCampoData) {
		construirCalendario(idCampoData);
		dt = $("#"+idCampoData).val();

		data = new Date();
		if (dt == null || dt == "") {
			ano = data.getFullYear(), mes = data.getMonth(), dia = data.getDate();
		} else {
			ano = dt.slice(6), mes = dt.slice(3,5), dia = dt.slice(0,2);
			ano = Number(ano), mes = Number(mes)-1, dia = Number(dia);
		}

		trueMes = mes + 1;
		ultimoDiaMesAtual = new Date(ano, mes+1, 0), ultimoDiaMesAtual = ultimoDiaMesAtual.getDate();
		ultimoDiaMesPassado = new Date(ano, mes, 0), ultimoDiaMesPassado = ultimoDiaMesPassado.getDate();
		data.setFullYear(ano, mes, 1);
		semana = data.getDay();

		if (semana == 0) {
			semana = 7;
		}

		organizarCalendario(semana, ultimoDiaMesPassado, ultimoDiaMesAtual, dia, idCampoData);

		if (dia < 10) {
			dia = zeroN[dia];
		}

		if (trueMes < 10) {
			trueMes = zeroN[trueMes];
		}

		$("#"+idCampoData).val(dia+"/"+(trueMes)+"/"+ano);
		$("#"+idCampoData+"idSelDataM").html("").text(mesExt[mes]);
		$("#"+idCampoData+"idAno").html("").text(ano);

		adicionarFuncoesCalendario(idCampoData);
	}

	function atualizarDataCalendario(dd, mm, aa, idCampoData) {
		data = new Date();
		ano = Number(aa), mes = Number(mm), dia = Number(dd);
		trueMes = Number(mm)+1;
		ultimoDiaMesAtual = new Date(ano, mes+1, 0), ultimoDiaMesAtual = ultimoDiaMesAtual.getDate();
		ultimoDiaMesPassado = new Date(ano, mes, 0), ultimoDiaMesPassado = ultimoDiaMesPassado.getDate();
		data.setFullYear(ano, mes, 1);
		semana = data.getDay();
		if (semana == 0) {
			semana = 7;
		}

		limparCalendario(idCampoData);
		organizarCalendario(semana, ultimoDiaMesPassado, ultimoDiaMesAtual, dia, idCampoData);

		if (dia < 10) {
			dia = zeroN[dia];
		}

		if (trueMes < 10) {
			trueMes = zeroN[trueMes];
		}

		$("#"+idCampoData).val(dia+"/"+trueMes+"/"+ano);
		$("#"+idCampoData+"idSelDataM").html("").text(mesExt[mes]);
		$("#"+idCampoData+"idAno").html("").text(ano);
	}

	function organizarCalendario(semana, udmp, udma, dd, idCampoData) {
		for (var i = semana-1; i >= 0; i--) {
			$("#"+idCampoData+"diaEspaco"+i).addClass("dia-outromes").text(udmp).val(udmp).click(function () {
				atualizarDataMesAnterior(this, idCampoData);
			});
			udmp--;
		}

		for (var i = 0; i < udma; i++) {
			dias = i+1;
			$("#"+idCampoData+"diaEspaco"+semana).addClass("dia-mes").text(dias).val(dias).click(function () {
				atualizarDataMesAtual(this, idCampoData);
			});
			if (dias == dd) {
				$("#"+idCampoData+"diaEspaco"+semana).addClass("ativo");
			}
			semana++;
		}

		semanaOutroMes = 42-semana;

		for (var i = 1; i <= semanaOutroMes; i++) {
			$("#"+idCampoData+"diaEspaco"+semana).addClass("dia-outromes").text(i).val(i).click(function () {
				atualizarDataMesPosterior(this, idCampoData);
			});
			semana++;
		}
	}

	function atualizarDataMesAnterior(id, idCampoData) {
		dia = $(id).val();
		data = $("#"+idCampoData).val();
		mes = data.slice(3, 5);
		ano = data.slice(6);

		mes--;
		if (mes == "00") {
			ano--;
			mes = 12;
		}
		mes = mes-1;

		atualizarDataCalendario(dia, mes, ano, idCampoData);
	}

	function atualizarDataMesAtual(id, idCampoData) {
		for (var i = 0; i <= 41; i++) {
			$("#"+idCampoData+"diaEspaco"+i).removeClass("ativo");
		}

		data = $("#"+idCampoData).val();
		mes = data.slice(3, 5);
		ano = data.slice(6);

		trueMes = mes;

		botaoTexto = $(id).text();
		if (botaoTexto < 10) {
			botaoTexto = zeroN[botaoTexto];
		}

		$(id).addClass("ativo");
		$("#"+idCampoData).val(botaoTexto+"/"+trueMes+"/"+ano);
	}

	function atualizarDataMesPosterior(id, idCampoData) {
		dia = $(id).val();
		data = $("#"+idCampoData).val();
		mes = data.slice(3, 5);
		ano = data.slice(6);

		mes++;
		if (mes == "13") {
			ano++;
			mes = 1;
		}
		mes = mes-1;

		atualizarDataCalendario(dia, mes, ano, idCampoData);
	}

	function limparCalendario(idCampoData) {
		for (var i = 0; i < 42; i++) {
			$("#"+idCampoData+"diaEspaco"+i).removeClass("dia-outromes dia-mes ativo").text("").unbind();
		}
	}

	function adicionarFuncoesCalendario(idCampoData) {

		$("#"+idCampoData+"idSetaDataE").click(function () {
			data = $("#"+idCampoData).val();
			mes = data.slice(3, 5);
			ano = data.slice(6);

			mes--;
			if (mes == "00") {
				ano--;
				mes = 12;
			}
			mes = mes-1;

			atualizarDataCalendario(1, mes, ano, idCampoData);
		});

		$("#"+idCampoData+"idSetaDataD").click(function () {
			data = $("#"+idCampoData).val();
			mes = data.slice(3, 5);
			ano = data.slice(6);

			mes++;
			if (mes == "13") {
				ano++;
				mes = 1;
			}
			mes = mes-1;

			atualizarDataCalendario(1, mes, ano, idCampoData);
		});

		$("#"+idCampoData+"idSelDataM").text(mesExt[mes]).click(function () {
			if ($("#"+idCampoData+"idMesLista").hasClass("ativado")) {
				$("#"+idCampoData+"idMesLista").toggleClass("ativado");
			} else {
				$("#"+idCampoData+"idMesLista").toggleClass("ativado");
			}
			$("#"+idCampoData+"idMesLista").mouseleave(function () {
				$("#"+idCampoData+"idMesLista").removeClass("ativado");
			})
		});

		$.each(mesExt, function (index, dados) {
			$("#"+idCampoData+"idMesLista").append(
				$("<button>", {
					id: "dataBotaoMes"+index,
					value: index,
					type: "button",
					class: "data-selecao-lista-botao"}
				).text(dados)
				.click(function () {
					$("#"+idCampoData+"idSelDataM").text($(this).text());
					data = $("#"+idCampoData).val();
					ano = data.slice(6);
					atualizarDataCalendario(1, $(this).val(), ano, idCampoData);
				})
			);
		});
	}
