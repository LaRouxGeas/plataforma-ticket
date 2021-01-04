$(document).ready(function(){

	function alterarDropArea(area, subArea, icone, mensagem) {
		$("#DeDCampo").removeClass().addClass(area);
		$("#DeDAreaEstilo").removeClass().addClass(subArea);
		$("#DeDIcone").removeClass().addClass(icone);
		$("#DeDMensagem").empty().append(mensagem);
	}

	function converteTipoArquivo(tipoArquivo) {
		if (tipoArquivo == "png" || tipoArquivo == "jpg" || tipoArquivo == "gif") {
			return "fas fa-file-image";
		}

		if (tipoArquivo == "wmv" || tipoArquivo == "mp4") {
			return "fas fa-file-video";
		}

		if (tipoArquivo == "docx") {
			return "fas fa-file-word";
		}

		if (tipoArquivo == "pptx") {
			return "fas fa-file-powerpoint";
		}

		if (tipoArquivo == "xlsx") {
			return "fas fa-file-excel";
		}

		if (tipoArquivo == "txt") {
			return "fas fa-file-signature";
		}

		if (tipoArquivo == "pdf") {
			return "fas fa-file-pdf";
		}

		if (tipoArquivo == "xml") {
			return "fas fa-file-alt";
		}

		if (tipoArquivo == "zip" || tipoArquivo == "rar") {
			return "fas fa-file-archive";
		}

		if (tipoArquivo == "mp3" || tipoArquivo == "wav" || tipoArquivo == "bin") {
			return "fas fa-file-audio";
		}

		return "fas fa-file";
	}

	function reduzirNomeArquivo(nome) {
		if (nome.length > 15) {
			nomeR = nome.slice(0, 10)+"-";
			index = nome.lastIndexOf(".");
			return nomeArquivo = nomeR+nome.slice(index);
		} else {
			return nome;
		}
	}

	function limpaDDarea(area)
	{
		$(area).removeClass("erro-div");
		id = $(area).attr('id');
		$("#"+id+"-erro").remove();
	}

	function visualizarArquivo(extencao, mime, local, id) {
		$("#idFundoJanela").html("").append(
			$("<div>", {class: "fundo-janela"}).append(
				$("<div>", {id:"adicionarConteudo", class:"borda-janela"}).append(
					$("<span>", {class: "fechar-janela fas fa-times"}).click(function () {
						$("#idFundoJanela").html("");
					})
				)
			)
		);
		if (extencao == "jpg" || extencao == "jpeg" || extencao == "png" || extencao == "gif") {
			$("#adicionarConteudo").append(
				$("<img>", {class:"view-arquivo-imagem", src:"/pttgcc"+local})
			);
		} else if (extencao == "docx" || extencao == "pptx" || extencao == "xlsx") {
			$("#adicionarConteudo").append(
				$("<iframe>", {src:"/pttgcc"+local, frameborder:"0", style:"width:100%;max-height:400px;"}),
				$("<h1>", {class:"descricao-arquivo-baixar"}).text("Abrindo arquivo...")
			);
		} else if (extencao == "pdf") {
			$("#adicionarConteudo").append(
				$("<iframe>", {src:"/pttgcc"+local, frameborder:"0", style:"width:100%;min-height:600px;"})
			);
		} else if (extencao == "mp3" || extencao == "wav" || extencao == "bin") {
			$("#adicionarConteudo").append(
				$("<audio>", {controls:""}).append(
					$("<source>", {src:"/pttgcc"+local, type:mime})
				)
			);
		} else {
			$("#adicionarConteudo").append(
				$("<h1>", {class:"descricao-arquivo-baixar"}).text("Clique aqui para baixar esse Arquivo."),
				$("<a>", {href:"/pttgcc/arquivo/"+id+"/download", target:"_blank", class: "icone-arquivo-baixar fas fa-arrow-alt-circle-down"})
				.click(function () {$("#idFundoJanela").html("");})
			);
		}
	}

	function deletarArquivo(id) {
		$.ajax({
			headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
			type: 'DELETE',
			url: '/pttgcc/arquivo/'+id,
			success: function(resposta) {
				$("[id*=containerArquivo][data-id="+id+"]").remove();
			},
			error: function(errors) {
				console.log(errors);
				mensagemErro = "Não foi possivel deletar o Arquivo!";
				$("#DeDCampo").addClass('erro-div').after(
					$("<p>", {id:"DeDCampo-erro", class:"erro-descricao"}).text(mensagemErro).click(function () {
						id = $(this).attr('id').slice(0, -5);
						$("#"+id).removeClass("erro-div");
						$(this).remove();
					})
				);
			}
		});
	}

	$("[id*=visualizarA]").click(function () {
		id = $("#containerArquivo").attr("data-id");
		ext = $(this).attr("data-ext");
		mime = $(this).attr("data-mime");
		local = $(this).attr("data-local");
		visualizarArquivo(ext, mime, local, id);
	});

	$("[id*=deletarA]").click(function () {
		id = $("#containerArquivo").attr("data-id");
		deletarArquivo(id);
	});

	$("[id*=downloadA]").click(function () {
		$("#idFundoJanela").html("");
	});

	$("#DeDCampo")
	.addClass('drop-area-capa')
	.append(
		$("<div>", {
			class:'drop-area',
			id: 'DeDAreaEstilo'
		}).append(
			$("<span>", {class: 'drop-icone fas fa-file-download', id: 'DeDIcone'}),
			$("<div>", {class: 'drop-texto', id:'DeDMensagem'}).append(
				$("<p>").text('Arraste e solte um arquivo!'),
				$("<p>").text('ou'),
				$("<label>", {class:'dd-botao', for:'uploadArquivo'}).text('Clique aqui'),
				$("<span>").text(" para anexar um arquivo! Máximo 2MB")
			)
		)
	);

	$("#DeDCampo").on('dragover dragenter', function(e) {
		e.preventDefault();
		limpaDDarea(this);
		dropMsg = "Solte para fazer o upload!";
		alterarDropArea('drop-area-capa ativa', 'drop-area ativa', 'drop-icone fas fa-arrow-down', dropMsg);
	});

	$("#DeDCampo").on('dragleave', function (e) {
		e.preventDefault();
		limpaDDarea(this);
		dropMsg = '<p>Arraste e solte um arquivo!</p>ou</br><label for="uploadArquivo" class="dd-botao">Clique aqui</label> para anexar um arquivo! Máximo 2MB';
		alterarDropArea('drop-area-capa', 'drop-area', 'drop-icone fas fa-file-download', dropMsg);
	});

	$("#DeDCampo").click(function () {
		limpaDDarea(this);
	});

	$("#DeDCampo").on('drop', function (e) {
		e.preventDefault();
		limpaDDarea(this);

		$.each(e.originalEvent.dataTransfer.files, function (index, info) {
			var DadosFormularios = new FormData();
			DadosFormularios.append('arquivo', info);
			enviarArquivos(DadosFormularios);
		});

		dropMsg = '<p>Arraste e solte um arquivo!</p>ou</br><label for="uploadArquivo" class="dd-botao">Clique aqui</label> para anexar um arquivo! Máximo 2MB';
		alterarDropArea('drop-area-capa', 'drop-area', 'drop-icone fas fa-file-download', dropMsg);
	});

	$("#uploadArquivo").change(function () {
		limpaDDarea($("#DeDCampo"));

		$.each($(this)[0].files, function (index, arquivo) {
			DadosFormularios = new FormData();
			DadosFormularios.append('arquivo', arquivo);
			enviarArquivos(DadosFormularios);
		})
	});

	function enviarArquivos(DadosFormularios) {
		$.ajax({
			headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
			type: 'POST',
			url: '/pttgcc/arquivo',
			data: DadosFormularios,
			contentType: false,
			cache: false,
			processData: false,
			dataType:'json',
			enctype: 'multipart/form-data',
			success: function(arquivo) {
				$("#DeDArquivos").append(
					$("<div>", {id:"containerArquivo", class: "t-temporario-item", title: arquivo.arq_nome, 'data-id':arquivo.arq_id}).append(
						$("<span>", {class:"t-arquivo-imagem "+converteTipoArquivo(arquivo.arq_extensao)}),
						$("<label>", {class:"t-arquivo-nome"}).text(reduzirNomeArquivo(arquivo.arq_nome)),
						$("<div>", {class:"t-arquivo-acoes"}).append(
							$("<span>", {class: "fas fa-times-circle t-arquivo-fechar"}).click(function () {
								deletarArquivo(arquivo.arq_id);
							}),
							$("<span>", {class: "fas fa-info-circle t-arquivo-visualizar"}).click(function () {
								visualizarArquivo(arquivo.arq_extensao, arquivo.arq_mime, arquivo.local_dinamico, arquivo.arq_id);
							}),
							$("<a>", {href:"/pttgcc/arquivo/"+arquivo.arq_id+"/download", target:"_blank", class: "fas fa-arrow-alt-circle-down t-arquivo-baixar"}).click(function () {
								$("#idFundoJanela").html("");
							}),
						)
					)
				);
			},
			error: function (errors) {
				if (errors.status == 422) {
					indexErro = Object.keys(errors.responseJSON.errors)[0];
					mensagemErro = errors.responseJSON.errors[indexErro][0];
					$("#DeDCampo").addClass('erro-div').after(
						$("<p>", {id:"DeDCampo-erro", class:"erro-descricao"}).text(mensagemErro).click(function () {
							id = $(this).attr('id').slice(0, -5);
							$("#"+id).removeClass("erro-div");
							$(this).remove();
						})
					);
				} else if (errors.status == 413) {
					mensagemErro = "O arquivo não pode ser maior que 2MB! @Estouro no upload de arquivo";
					$("#DeDCampo").addClass('erro-div').after(
						$("<p>", {id:"DeDCampo-erro", class:"erro-descricao"}).text(mensagemErro).click(function () {
							id = $(this).attr('id').slice(0, -5);
							$("#"+id).removeClass("erro-div");
							$(this).remove();
						})
					);
				} else {
					mensagemErro = "Erro desconhecido, tente recarregar a página!"
					$("#DeDCampo").addClass('erro-div').after(
						$("<p>", {id:"DeDCampo-erro", class:"erro-descricao"}).text(mensagemErro).click(function () {
							id = $(this).attr('id').slice(0, -5);
							$("#"+id).removeClass("erro-div");
							$(this).remove();
						})
					);
				}
			}
		});
	}

	$("#cancelarTicketMensagem").click(function () {
		pagina = window.location.pathname;
		idTicket = pagina.split('/');
		idTicket = idTicket[3];

		token = $('input[name="_token"]').val();
		$("#idFundoJanela").append(
			$("<div>", {class: "fundo-janela"}).append(
				$("<form>", {class:"janela-cancelar", method:"POST", action:"/pttgcc/ticket/"+idTicket+"/cancelar"}).append(
					$("<input>", {type:"hidden", name:"_token", value:token}),
					$("<input>", {type:"hidden", name:"_method", value:"PATCH"}),
					$("<div>", {class:"campo-form"}).append(
						$("<h2>", {class:"lista-descricao"}).text("Deixar uma observação?"),
						$("<textarea>", {class:"textarea", name:"tic_obs_solicitante"})
					),
					$("<div>", {class:"campo-form"}).append(
						$("<div>", {class:"lista-botoes"}).append(
							$("<input>", {type:"submit", name:"enviar", value:"Confirmar", class:"botao-enviar"}),
							$("<button>", {type:"button", class:"botao-enviar"}).text("Cancelar").click(function () {
								$("#idFundoJanela").html("");
							})
						)
					)
				)
			)
		)
	});

	$("[id*='outros']").click(function () {
		$("[id*='outrosCampo']").html("");
		var rota = $(this).attr("data-rota");
		var prefix = $(this).attr("data-pre");
		var campoNome = $(this).attr("data-nomecampo");
		var checkname = $(this).attr("data-nome");
		var mesmoNome = '';
		var confirmar = false;
		$(this).after(
			$("<div>", {id:"outrosCampo"+prefix, class:"campo-outros"}).append(
				$("<h2>", {class:"titulo-site"}).text(campoNome),
				$("<div>", {class:"campo-form"}).append(
					$("<h3>", {class:"lista-descricao"}).text("Nome"),
					$("<input>", {id:"_nome", type:"text", name:prefix+"_nome", class:"input", placeholder:"Nome"})
				),
				$("<div>", {class:"campo-form"}).append(
					$("<h3>", {class:"lista-descricao"}).text("Descrição"),
					$("<textarea>", {id:"_descricao", name:prefix+"_descricao", class:"textarea", placeholder:"Descrição"})
				),
				$("<div>", {class:"campo-form"}).append(
					$("<div>", {class:'lista-botoes'}).append(
						$("<button>", {class:"botao-enviar", type:"button"}).text("Cancelar")
						.click(function () {
							$("#outrosCampo"+prefix).html("").remove();
						}),
						$("<button>", {class:"botao-enviar", type:"button"}).text("Confirmar")
						.click(function () {
							var nome = $("#_nome").val();
							var desc = $("#_descricao").val();
							console.log({nome:nome, mesmo:mesmoNome, confirmar:confirmar});
							if ((mesmoNome.length == 0 || mesmoNome != nome) || confirmar == false) {
								mesmoNome = nome;
								$.ajax({
									headers: {'X-CSRF-Token': $('input[name="_token"]').val()},
									type: 'GET',
									url: '/pttgcc/similaridade',
									data: {nomeOutro:nome, nomeTabela:checkname},
									success: function(item) {
										$("#idFundoJanela").html("").append(
											$("<div>", {class: "fundo-janela"}).append(
												$("<div>", {class:"janela-media"}).append(
													$("<div>", {class:"campo-form"}).append(
														$("<h2>", {class:"lista-descricao"}).text('Um nome similar ao que você tentou cadastrar já existe: "'+item+'". Deseja continuar mesmo assim?'),
													),
													$("<div>", {class:"campo-form"}).append(
														$("<div>", {class:"lista-botoes"}).append(
															$("<button>", {type:"button", class:"botao-enviar"}).text("Continuar").click(function () {
																$("#idFundoJanela").html("");
																confirmar = true;
																criarOutros(rota, prefix, checkname, nome, desc);
															}),
															$("<button>", {type:"button", class:"botao-enviar"}).text("Cancelar").click(function () {
																$("#idFundoJanela").html("");
																confirmar = false;
															})
														)
													)
												)
											)
										)
									},
									error: function (errors) {
										criarOutros(rota, prefix, checkname, nome, desc);
									}
								});
								if (mesmoNome != nome) {
									confirmar = false;
								}
							} else {
								criarOutros(rota, prefix, checkname, nome, desc);
							}
						})
					)
				)
			)
		);
	});

	function criarOutros(rota, pre, checkName, nome, descricao) {
		$.ajax({
			headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
			type: 'POST',
			url: '/pttgcc/'+rota+'/outros',
			data: { [pre+'_nome']:nome, [pre+'_descricao']:descricao},
			success: function(item) {
				var prefixoIdItem = pre+item[pre+'_id'];
				$("#"+rota+"Ticket").append(
					$("<div>", {class:"checkbox-opcao"}).append(
						$("<input>", {id:"check"+prefixoIdItem, type:"checkbox", name:checkName+"["+item[pre+'_id']+"]", class:"input-hidden", value:item[pre+'_id'], checked:""}),
						$("<label>", {for:"check"+prefixoIdItem, id:"visualCheckbox"+prefixoIdItem, class:"check-visual-dinamico ativado"}).click(function () {
							$(this).toggleClass("ativado");
						}),
						$("<label>", {for:"check"+prefixoIdItem, class:"check-descricao"}).text(item[pre+'_nome'])
						.hover(function () {
							$("#visualCheckbox"+prefixoIdItem).toggleClass("sobre");
						})
						.click(function () {
							$("#visualCheckbox"+prefixoIdItem).toggleClass("ativado");
						})
					)
				);
				var itens = $("#"+rota+"Ticket").children().length;
				var nLinhas = Math.floor(itens/3);
				nLinhas = itens%3 != 0 ? (nLinhas+1).toFixed() : nLinhas.toFixed();
				var regra = 'grid-template-rows: repeat('+nLinhas+',auto);';
				$("#"+rota+"Ticket").attr("style", regra);
				$("#outrosCampo"+pre).html("").remove();
			},
			error: function (errors) {
				if (errors.status == 422) {
					indexErro = Object.keys(errors.responseJSON.errors);
					$("[id*=erroOutros]").remove();
					$.each(indexErro, function (index, erro) {
						mensagem = errors.responseJSON.errors[erro];

						$("[name="+erro+"]").addClass('erro-input').after(
							$("<p>", {id:erro+"erroOutros", class:"erro-descricao"}).text(mensagem).click(function () {
								$("[name="+erro+"]").removeClass('erro-input');
								$(this).remove();
							})
						).click(function () {
							$(this).removeClass('erro-input');
							$("#"+erro+"erroOutros").remove();
						});
					});
				} else {
					console.log(errors);
					$("#outrosCampo"+pre).html("").remove();
				}
			}
		});
	}

	function montarTickets(tipoPagina, pagina = 1) {
		$.ajax({
			headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
			type: 'GET',
			url: '/pttgcc/ticket/solicitacoes',
			data: {page:pagina, tipo:tipoPagina},
			enctype: 'multipart/form-data',
			success: function(retorno) {
				console.log(retorno);
				$("#solicitacoes").html('');
				$.each(retorno.data, function (index, ticket) {
					if (ticket.estado.est_id == 1 && ticket.tic_fk_autor == idUser) {
						rotaTicket = "/pttgcc/ticket/"+ticket.tic_id+"/edit";
					} else if((ticket.estado.est_id != 1 && ticket.estado.est_id != 6) && ticket.tic_fk_avaliador == idUser) {
						rotaTicket = "/pttgcc/ticket/"+ticket.tic_id+"/revisar"
					} else {
						rotaTicket = "/pttgcc/ticket/"+ticket.tic_id;
					}

					if (ticket.aprovador == null) {
						avaliador = "Sem Aprovador";
					} else {
						avaliador = ticket.aprovador.name;
					}

					var titulo = ticket.tic_titulo ? ticket.tic_titulo : "Sem Título";

					criado_em = ticket.tic_criado_em.slice(8,10)+'/'+ticket.tic_criado_em.slice(5,7)+'/'+ticket.tic_criado_em.slice(0,4);

					if (ticket.arquivos.length > 0) {
						arquivo = "fas fa-file";
						arquivotitulo = "Contêm Anexos";
					} else {
						arquivo = "fas fa-ban";
						arquivotitulo = "Sem Anexos";
					}

					var analiseAtraso = ticket.estado.est_id == 7 ? 'erro-descricao' : '';

					$("#solicitacoes").append(
						$("<a>", {class:"ticket-tabela ticket", href:rotaTicket}).append(
							$("<span>", {class:"ticket-item"}).text(ticket.tic_id),
							$("<span>", {class:"ticket-item"}).text(titulo),
							$("<span>", {class:"ticket-item"}).text(ticket.autor.name),
							$("<span>", {class:"ticket-item"}).text(avaliador),
							$("<span>", {class:"ticket-item"}).text(criado_em),
							$("<span>", {class:"ticket-item "+analiseAtraso}).text(ticket.estado.est_nome),
							$("<span>", {class:"ticket-item "+arquivo, title:arquivotitulo})
						)
					);

				});

				$("#paginas").html('');

				if (retorno.prev_page_url == null) {
					$("#paginas").append(
						$("<label>", {class:"paginacao-item nao-usado"}).append(
							$("<span>", {class:"paginacao-seta fas fa-caret-left"})
						)
					);
				} else {
					$("#paginas").append(
						$("<label>", {class:"paginacao-item"}).append(
							$("<span>", {class:"paginacao-seta fas fa-caret-left"})
						).click(function () {
							montarTickets(tipoPagina, retorno.current_page-1);
						})
					);
				}

				if (retorno.last_page < 8) {
					for (var i = 1; i <= retorno.last_page; i++) {
						if (retorno.current_page == i) {
							$("#paginas").append(
								$("<label>", {class:"paginacao-item ativo"}).text(i)
							);
						} else {
							$("#paginas").append(
								$("<label>", {class:"paginacao-item", val:i}).text(i).click(function () {
									montarTickets(tipoPagina, this.value);
								})
							);
						}
					}
				} else {
					if (retorno.prev_page_url == null) {
						$("#paginas").append(
							$("<label>", {class:"paginacao-item ativo" , val:1}).text(1),
							$("<label>", {class:"paginacao-item", val:2}).text(2).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item", val:3}).text(3).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.last_page}).text(retorno.last_page).click(function () {
								montarTickets(tipoPagina, this.value);
							})
						);
					}
					if (retorno.next_page_url == null) {
						$("#paginas").append(
							$("<label>", {class:"paginacao-item" , val:1}).text(1).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.last_page-2}).text(retorno.last_page-2).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item", val:retorno.last_page-1}).text(retorno.last_page-1).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item ativo", val:retorno.last_page}).text(retorno.last_page)
						);
					}
					if (retorno.current_page == 2) {
						$("#paginas").append(
							$("<label>", {class:"paginacao-item" , val:1}).text(1).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item ativo", val:2}).text(2),
							$("<label>", {class:"paginacao-item", val:3}).text(3).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item", val:4}).text(4).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.last_page}).text(retorno.last_page).click(function () {
								montarTickets(tipoPagina, this.value);
							})
						);
					}
					if (retorno.current_page == retorno.last_page-1) {
						$("#paginas").append(
							$("<label>", {class:"paginacao-item" , val:1}).text(1).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.last_page-3}).text(retorno.last_page-3).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item", val:retorno.last_page-2}).text(retorno.last_page-2).click(function () {
								montarTickets(tipoPagina, this.value);
							}),
							$("<label>", {class:"paginacao-item ativo", val:retorno.last_page-1}).text(retorno.last_page-1),
							$("<label>", {class:"paginacao-item", val:retorno.last_page}).text(retorno.last_page)
						);
					}
					if (retorno.last_page-1 > retorno.current_page && retorno.current_page > 2) {
						$("#paginas").append(
							$("<label>", {class:"paginacao-item" , val:1}).text(1).click(function () {montarTickets(tipoPagina, this.value);}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.current_page-2}).text(retorno.current_page-2).click(function () {montarTickets(tipoPagina, this.value);}),
							$("<label>", {class:"paginacao-item", val:retorno.current_page-1}).text(retorno.current_page-1).click(function () {montarTickets(tipoPagina, this.value);}),
							$("<label>", {class:"paginacao-item ativo", val:retorno.current_page}).text(retorno.current_page),
							$("<label>", {class:"paginacao-item ", val:retorno.current_page+1}).text(retorno.current_page+1).click(function () {montarTickets(tipoPagina, this.value);}),
							$("<label>", {class:"paginacao-item ", val:retorno.current_page+2}).text(retorno.current_page+2).click(function () {montarTickets(tipoPagina, this.value);}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.last_page}).text(retorno.last_page).click(function () {montarTickets(tipoPagina, this.value);})
						);
					}
				}

				if (retorno.next_page_url == null) {
					$("#paginas").append(
						$("<label>", {class:"paginacao-item nao-usado"}).append(
							$("<span>", {class:"paginacao-seta fas fa-caret-right"})
						)
					);
				} else {
					$("#paginas").append(
						$("<label>", {class:"paginacao-item"}).append(
							$("<span>", {class:"paginacao-seta fas fa-caret-right"})
						).click(function () {
							montarTickets(tipoPagina, retorno.current_page+1);
						})
					)
				}
			},
			error: function () {
				alert("Erro ao trazer tickets!");
			}
		});
	}

	$("#botaoPesquisaId").click(function () {
		$("#campoPesquisa").empty().append(
			$("<div>", {class:"campo-form"}).append(
				$("<h3>", {class:"lista-descricao"}).text("Pesquisar Ticket por Protocolo:"),
				$("<input>", {type:"text", name:"pesquisaId", class:"input", id:"pesquisaId"})
			),
			$("<div>", {class:"campo-form lista-botoes"}).append(
				$("<button>", {class:"botao-enviar"}).text("Pesquisar").click(function () {
					id = $("#pesquisaId").val();
					pesquisarTicket(1, id);
				})
			)
		);
	});

	$("#botaoPesquisaTitulo").click(function () {
		$("#campoPesquisa").empty().append(
			$("<div>", {class:"campo-form"}).append(
				$("<h3>", {class:"lista-descricao"}).text("Pesquisar Ticket por Título:"),
				$("<input>", {type:"text", name:"pesquisaTitulo", class:"input", id:"pesquisaTitulo"}),
			),
			$("<div>", {class:"campo-form lista-botoes"}).append(
				$("<button>", {class:"botao-enviar"}).text("Pesquisar").click(function () {
					titulo = $("#pesquisaTitulo").val();
					pesquisarTicket(1, undefined, titulo);
				})
			)
		);
	});

	$("#botaoPesquisaSolicitante").click(function () {
		$.ajax({
			headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
			type: 'GET',
			url: "/pttgcc/usuario/solicitantes",
			enctype: 'multipart/form-data',
			success: function(retorno) {
				$("#campoPesquisa").empty().append(
					$("<div>", {class:"campo-form"}).append(
						$("<h3>", {class:"lista-descricao"}).text("Pesquisar Ticket por Solicitantes:"),
						$("<div>", {id:"listaSolicitante", class:"pesquisa-lista"})
					)
				);
				$.each(retorno, function(index, dados) {
					$("#listaSolicitante").append(
						$("<input>", {type:"checkbox", id:"solicitanteId"+dados.id, class:"input-hidden", value:dados.id}),
						$("<label>", {for:"solicitanteId"+dados.id, class:"pesquisa-checkbox"})
							.text(dados.name)
							.click(function () {
								$(this).toggleClass("ativado");
							})
					);
				});
				$("#campoPesquisa").append(
					$("<div>", {class:"campo-form lista-botoes"}).append(
						$("<button>", {class:"botao-enviar"}).text("Pesquisar").click(function () {
							solicitantes = [];
							$.each($("[id*=solicitanteId]:checked"), function (i, d) {
								if ( $(d).is(":checked") ) {
									solicitantes.push($(d).val());
								}
							});
							pesquisarTicket(1, undefined, undefined, solicitantes);
						})
					)
				);
			},
			error: function () {
				console.log("Erros ao trazer os Solicitantes!");
			}
		});
	});

	$("#botaoPesquisaAprovador").click(function () {
		$.ajax({
			headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
			type: 'GET',
			url: "/pttgcc/usuario/aprovadores",
			enctype: 'multipart/form-data',
			success: function(retorno) {
				$("#campoPesquisa").empty().append(
					$("<div>", {class:"campo-form"}).append(
						$("<h3>", {class:"lista-descricao"}).text("Pesquisar Ticket por Aprovadores:"),
						$("<div>", {id:"listaAprovadores", class:"pesquisa-lista"})
					)
				);
				$.each(retorno, function(index, dados) {
					$("#listaAprovadores").append(
						$("<input>", {type:"checkbox", id:"aprocadorId"+dados.id, class:"input-hidden", value:dados.id}),
						$("<label>", {for:"aprocadorId"+dados.id, class:"pesquisa-checkbox"})
							.text(dados.name)
							.click(function () {
								$(this).toggleClass("ativado");
							})
					);
				});
				$("#campoPesquisa").append(
					$("<div>", {class:"campo-form lista-botoes"}).append(
						$("<button>", {class:"botao-enviar"}).text("Pesquisar").click(function () {
							aprovadores = [];
							$.each($("[id*=aprocadorId]:checked"), function (i, d) {
								if ( $(d).is(":checked") ) {
									aprovadores.push($(d).val());
								}
							});
							pesquisarTicket(1, undefined, undefined, undefined, aprovadores);
						})
					)
				);
			},
			error: function () {
				console.log("Erros ao trazer os Aprovadores!");
			}
		});
	});

	$("#botaoPesquisaDataCriacao").click(function () {
		$("#campoPesquisa").empty().append(
			$("<div>", {class:"campo-form"}).append(
				$("<h3>", {class:"lista-descricao"}).text("Pesquisar Ticket por Data de Criação:"),
				$("<div>", {class:"campo-data"}).append(
					$("<h3>", {class:"lista-descricao"}).text("De:"),
					$("<input>", {type:"text", name:"pesquisaDataCriacao", class:"input-data", id:"dtCriacaoIni"}).click(function () {
						alternarEstadoCalendario("dtCriacaoIni");
					})
				),
				$("<div>", {class:"campo-data"}).append(
					$("<h3>", {class:"lista-descricao"}).text("Até:"),
					$("<input>", {type:"text", name:"pesquisaDataCriacao", class:"input-data", id:"dtCriacaoFin"}).click(function () {
						alternarEstadoCalendario("dtCriacaoFin");
					})
				),
			),
			$("<div>", {class:"campo-form lista-botoes"}).append(
				$("<button>", {class:"botao-enviar"}).text("Pesquisar").click(function () {
					dtCriacaoIni = $("#dtCriacaoIni").val();
					dtCriacaoFin = $("#dtCriacaoFin").val();
					datasCriacao = dtCriacaoIni+"|"+dtCriacaoFin;
					pesquisarTicket(1, undefined, undefined, undefined, undefined, datasCriacao);
				})
			)
		);

		iniciarCalendario("dtCriacaoIni");
		iniciarCalendario("dtCriacaoFin");
	});

	$("#botaoPesquisaDataAtualizado").click(function () {
		$("#campoPesquisa").empty().append(
			$("<div>", {class:"campo-form"}).append(
				$("<h3>", {class:"lista-descricao"}).text("Pesquisar Ticket por Data de Status:"),
				$("<div>", {class:"campo-data"}).append(
					$("<h3>", {class:"lista-descricao"}).text("De:"),
					$("<input>", {type:"text", name:"pesquisaDataEstado", class:"input-data", id:"dtEstadoIni"}).click(function () {
						alternarEstadoCalendario("dtEstadoIni");
					})
				),
				$("<div>", {class:"campo-data"}).append(
					$("<h3>", {class:"lista-descricao"}).text("Até:"),
					$("<input>", {type:"text", name:"pesquisaDataEstado", class:"input-data", id:"dtEstadoFin"}).click(function () {
						alternarEstadoCalendario("dtEstadoFin");
					})
				),
			),
			$("<div>", {class:"campo-form lista-botoes"}).append(
				$("<button>", {class:"botao-enviar"}).text("Pesquisar").click(function () {
					dtEstadoIni = $("#dtEstadoIni").val();
					dtEstadoFin = $("#dtEstadoFin").val();
					datasEstado = dtEstadoIni+"|"+dtEstadoFin;
					pesquisarTicket(1, undefined, undefined, undefined, undefined, undefined, datasEstado);
				})
			)
		);

		iniciarCalendario("dtEstadoIni");
		iniciarCalendario("dtEstadoFin");
	});

	$("#botaoPesquisaStatus").click(function () {
		$.ajax({
			headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
			type: 'GET',
			url: "/pttgcc/estado",
			enctype: 'multipart/form-data',
			success: function(retorno) {
				$("#campoPesquisa").empty().append(
					$("<div>", {class:"campo-form"}).append(
						$("<h3>", {class:"lista-descricao"}).text("Pesquisar Ticket por Status:"),
						$("<div>", {id:"listaStatus"})
					)
				);
				$.each(retorno, function(index, dados) {
					$("#listaStatus").append(
						$("<div>", {class:"busca-checkbox-opcao"}).append(
							$("<input>", {type:"checkbox", id:"checkEst"+dados.est_id, class:"input-hidden", value:dados.est_id}),
							$("<label>", {for:"checkEst"+dados.est_id, id:"visualCheckboxEst"+dados.est_id, class:"busca-check-visual"})
							.click(function () {
								$(this).toggleClass("ativado");
							}),
							$("<label>", {for:"checkEst"+dados.est_id, id:"descricaoCheckboxEst"+dados.est_id, class:"check-descricao"})
							.text(dados.est_nome)
							.hover(function () {
								$("#visualCheckboxEst"+dados.est_id).toggleClass("sobre");
							})
							.click(function () {
								$("#visualCheckboxEst"+dados.est_id).toggleClass("ativado");
							})
						)
					);
				});
				$("#campoPesquisa").append(
					$("<div>", {class:"campo-form lista-botoes"}).append(
						$("<button>", {class:"botao-enviar"}).text("Pesquisar").click(function () {
							estados = [];
							$.each($("[id*=checkEst]:checked"), function (i, d) {
								if ( $(d).is(":checked") ) {
									estados.push($(d).val());
								}
							});
							pesquisarTicket(1, undefined, undefined, undefined, undefined, undefined, undefined, estados);
						})
					)
				);
			},
			error: function () {
				console.log("Erros ao trazer os Status!");
			}
		});
	});

	$("#botaoPesquisaAnexos").click(function () {
		$("#campoPesquisa").empty().append(
			$("<div>", {class:"campo-form"}).append(
				$("<h3>", {class:"lista-descricao"}).text("Pesquisar Ticket:"),
				$("<button>", {class:"botao-enviar"}).text("Com Anexos").click(function () {
					pesquisarTicket(1, undefined, undefined, undefined, undefined, undefined, undefined, undefined, 1);
				}),
				$("<button>", {class:"botao-enviar"}).text("Sem Anexos").click(function () {
					pesquisarTicket(1, undefined, undefined, undefined, undefined, undefined, undefined, undefined, 0);
				})
			)
		);
	});

	function pesquisarTicket(pagina = 1, id = null, titulo = null, solicitante = null, aprovador = null, criadoEm = null, atualizadoEm = null, status = null, anexos = null) {
		$.ajax({
			headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
			type: 'GET',
			url: '/pttgcc/ticket/pesquisa',
			data: {
				page:pagina,
				ticId:id,
				ticTitulo:titulo,
				ticSolicitante:solicitante,
				ticAprovador:aprovador,
				ticCriado:criadoEm,
				ticAtualizado: atualizadoEm,
				ticStatus:status,
				ticArquivos:anexos
			},
			success: function(retorno) {
				console.log(retorno);
				$("#solicitacoes").html('');

				$("#campoPesquisaTicket").append(
					$("<button>", {class:"botao-enviar botao-reverso", id:"botaoPesquisaLimpar"})
					.text("Todos")
					.click(function () {
						montarTickets("pesquisa");
						$("#campoPesquisa").empty();
						$("#botaoPesquisaLimpar").remove();
					})
				)

				$.each(retorno.data, function (index, ticket) {
					if (ticket.estado.est_id == 1 && ticket.tic_fk_autor != idUser) {
						rotaTicket = "/pttgcc/ticket/"+ticket.tic_id+"/edit";
					} else if((ticket.estado.est_id != 1 && ticket.estado.est_id != 6) && ticket.tic_fk_avaliador == idUser) {
						rotaTicket = "/pttgcc/ticket/"+ticket.tic_id+"/revisar"
					} else {
						rotaTicket = "/pttgcc/ticket/"+ticket.tic_id;
					}

					if (ticket.aprovador == null) {
						avaliador = "Sem Aprovador";
					} else {
						avaliador = ticket.aprovador.name;
					}

					if (ticket.tic_titulo == null) {
						tituloTicket = "Sem Título";
					} else {
						tituloTicket = ticket.tic_titulo;
					}

					criado_em = ticket.tic_criado_em.slice(8,10)+'/'+ticket.tic_criado_em.slice(5,7)+'/'+ticket.tic_criado_em.slice(0,4);

					if (ticket.arquivos.length > 0) {
						arquivo = "fas fa-file";
						arquivotitulo = "Contêm Anexos";
					} else {
						arquivo = "fas fa-ban";
						arquivotitulo = "Sem Anexos";
					}
					$("#solicitacoes").append(
						$("<a>", {class:"ticket-tabela ticket", href:rotaTicket}).append(
							$("<span>", {class:"ticket-item"}).text(ticket.tic_id),
							$("<span>", {class:"ticket-item"}).text(tituloTicket),
							$("<span>", {class:"ticket-item"}).text(ticket.autor.name),
							$("<span>", {class:"ticket-item"}).text(avaliador),
							$("<span>", {class:"ticket-item"}).text(criado_em),
							$("<span>", {class:"ticket-item"}).text(ticket.estado.est_nome),
							$("<span>", {class:"ticket-item "+arquivo, title:arquivotitulo})
						)
					);

				});

				$("#paginas").html('');

				if (retorno.prev_page_url == null) {
					$("#paginas").append(
						$("<label>", {class:"paginacao-item nao-usado"}).append(
							$("<span>", {class:"paginacao-seta fas fa-caret-left"})
						)
					);
				} else {
					$("#paginas").append(
						$("<label>", {class:"paginacao-item"}).append(
							$("<span>", {class:"paginacao-seta fas fa-caret-left"})
						).click(function () {
							pesquisarTicket(pagina-1, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
						})
					);
				}

				if (retorno.last_page < 8) {
					for (var i = 1; i <= retorno.last_page; i++) {
						if (retorno.current_page == i) {
							$("#paginas").append(
								$("<label>", {class:"paginacao-item ativo"}).text(i)
							);
						} else {
							$("#paginas").append(
								$("<label>", {class:"paginacao-item", val:i}).text(i).click(function () {
									pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
								})
							);
						}
					}
				} else {
					if (retorno.prev_page_url == null) {
						$("#paginas").append(
							$("<label>", {class:"paginacao-item ativo" , val:1}).text(1),
							$("<label>", {class:"paginacao-item", val:2}).text(2).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item", val:3}).text(3).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.last_page}).text(retorno.last_page).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							})
						);
					}
					if (retorno.next_page_url == null) {
						$("#paginas").append(
							$("<label>", {class:"paginacao-item" , val:1}).text(1).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.last_page-2}).text(retorno.last_page-2).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item", val:retorno.last_page-1}).text(retorno.last_page-1).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item ativo", val:retorno.last_page}).text(retorno.last_page)
						);
					}
					if (retorno.current_page == 2) {
						$("#paginas").append(
							$("<label>", {class:"paginacao-item" , val:1}).text(1).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item ativo", val:2}).text(2),
							$("<label>", {class:"paginacao-item", val:3}).text(3).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item", val:4}).text(4).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.last_page}).text(retorno.last_page).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							})
						);
					}
					if (retorno.current_page == retorno.last_page-1) {
						$("#paginas").append(
							$("<label>", {class:"paginacao-item" , val:1}).text(1).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.last_page-3}).text(retorno.last_page-3).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item", val:retorno.last_page-2}).text(retorno.last_page-2).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item ativo", val:retorno.last_page-1}).text(retorno.last_page-1),
							$("<label>", {class:"paginacao-item", val:retorno.last_page}).text(retorno.last_page)
						);
					}
					if (retorno.last_page-1 > retorno.current_page && retorno.current_page > 2) {
						$("#paginas").append(
							$("<label>", {class:"paginacao-item" , val:1}).text(1).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.current_page-2}).text(retorno.current_page-2).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item", val:retorno.current_page-1}).text(retorno.current_page-1).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item ativo", val:retorno.current_page}).text(retorno.current_page),
							$("<label>", {class:"paginacao-item ", val:retorno.current_page+1}).text(retorno.current_page+1).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item ", val:retorno.current_page+2}).text(retorno.current_page+2).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
							}),
							$("<label>", {class:"paginacao-item nao-usado"}).text("..."),
							$("<label>", {class:"paginacao-item", val:retorno.last_page}).text(retorno.last_page).click(function () {
								pesquisarTicket(this.value, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos)
							;})
						);
					}
				}

				if (retorno.next_page_url == null) {
					$("#paginas").append(
						$("<label>", {class:"paginacao-item nao-usado"}).append(
							$("<span>", {class:"paginacao-seta fas fa-caret-right"})
						)
					);
				} else {
					$("#paginas").append(
						$("<label>", {class:"paginacao-item"}).append(
							$("<span>", {class:"paginacao-seta fas fa-caret-right"})
						).click(function () {
							pesquisarTicket(pagina+1, id, titulo, solicitante, aprovador, criadoEm, atualizadoEm, status, anexos);
						})
					)
				}
			},
			error: function () {
				alert("Erro na pesquisar!");
			}
		});
	}

	if ($("#solicitacoes").length) {
		tipoPagina = $("#solicitacoes").attr("data-pagina");
		montarTickets(tipoPagina);
	}

	/**
	 * Ativa a checkbox visuais clicada.
	 *
	 */
	$("[id^=visualCheckbox]")
	.click(function() {
		$(this).toggleClass("ativado");
	});

	/**
	 * Procura a checkbox marcadas, e liga com a checkbox visual.
	 *
	 */
	$("[id*=check]:checked").each(function () {
		idMaisGrupo = ($(this)[0].id).slice(5);
		$("#visualCheckbox"+idMaisGrupo).addClass("ativado");
	});

	/**
	 * Se o mouse ficar sobre a descrição da checkbox visual, da a classe .sobre,
	 * se for clicada, marca a checkbox visual.
	 *
	 */
	$("[id*=descricaoCheckbox]")
	.hover(function() {
		id = ($(this)[0].id).slice(17);
		$("#visualCheckbox"+id).toggleClass("sobre");
	})
	.click(function() {
		id = ($(this)[0].id).slice(17);
		$("#visualCheckbox"+id).toggleClass("ativado");
	});

	// ---------------------------------------------

	/**
	 * Marca as checkbox marcadas com checked.
	 *
	 */
	$("[id*=Ccheck]:checked").each(function () {
		idMaisGrupo = ($(this)[0].id).slice(6);
		$("#CvisualCheckbox"+idMaisGrupo).addClass("ativado");
	});

	// ---------------------------------------------

	/**
	 * Procura a radio visual marcada, e ativa.
	 *
	 */
	$("[id*=radio]:checked").each(function () {
		idMaisGrupo = ($(this)[0].id).slice(5);
		$("[id*=radio"+idMaisGrupo+"]").removeClass("ativado");
		$("#visualRadio"+idMaisGrupo).addClass("ativado");
	});

	/**
	 * Ativa o radio visual clicado e desativa todos os outros.
	 *
	 */
	$("[id*=visualRadio]").click(function() {
		idMaisGrupo = ($(this)[0].id).slice(0, 14);
		$("[id*="+idMaisGrupo+"]").removeClass("ativado");
		$(this).toggleClass("ativado");
	});

	/**
	 * Se o mouse ficar sobre a descrição do radio visual coloca a classe .sobre,
	 * se a descrição for clicada, marca a radio visual e desmarca as outras.
	 *
	 */
	$("[id*=descricaoRadio]")
	.hover(function() {
		idMaisGrupo = ($(this)[0].id).slice(14);
		$("#visualRadio"+idMaisGrupo).toggleClass("sobre");
	})
	.click(function() {
		Grupo = ($(this)[0].id).slice(14, 17);
		idMaisGrupo = ($(this)[0].id).slice(14);
		$("[id*=visualRadio"+Grupo+"]").removeClass("ativado");
		$("#visualRadio"+idMaisGrupo).toggleClass("ativado");
	});

	// --------------------------------------------------------

	$("[id*=CRadio]:checked").each(function () {
		idMaisGrupo = ($(this)[0].id).slice(6);
		$("#CvisualRadio"+idMaisGrupo).addClass("ativado");
	});

	// --------------------------------------------------------

	$(".erro-input").click(function () {
		$(this).removeClass("erro-input");
		id = $(this).attr('id');
		$("#"+id+"-erro").remove();
	});

	$("[id$=-erro]").click(function () {
		id = $(this).attr('id').slice(0, -5);
		$("#"+id).removeClass("erro-input").removeClass("erro-div");
		$(this).remove();
	});

	$(".erro-div").click(function () {
		$(this).removeClass("erro-div");
		id = $(this).attr('id');
		$("#"+id+"-erro").remove();
	});

	$("[id*=menudrop]").click(function(){
		$(this).toggleClass('ativo');
		$(this).next().toggleClass('ativo');
	});

	$("[id*=menulista]").mouseleave(function(){
		$("[id*=menudrop]").removeClass('ativo');
		$("[id*=menudrop]").next().removeClass('ativo');
	});

	$('.lista-itens-coluna').each(function() {
		var itens = $(this).children().length;
		var nLinhas = Math.floor(itens/3);
		nLinhas = itens%3 != 0 ? (nLinhas+1).toFixed() : nLinhas.toFixed();
		var regra = 'grid-template-rows: repeat('+nLinhas+',auto);';
		$(this).attr("style", regra);
	});

	// $('.lista-item-dominio-borda').each(function() {
	// 	itens = $(this).children().length;

	// 	if (itens == 1) {
	// 		regras = "grid-template-columns: auto; grid-template-rows: auto; width: 33%;"
	// 	} else if (itens == 2) {
	// 		regras = "grid-template-columns: auto auto; grid-template-rows: auto; width: 66%; "
	// 	} else {
	// 		if (itens%2 == 0) {

	// 		} else {

	// 		}
	// 		numeroLinhas = Math.floor(itens/2);
	// 		numeroLinhas = itens%2 != 0 ? (numeroLinhas+1) : numeroLinhas;
	// 		numeroLinhas.toFixed();
	// 		regras = "grid-template-columns: auto auto auto; grid-template-rows: repeat("+numeroLinhas+",auto);  width: 100%;"
	// 	}
	// 	$(this).attr("style", regras);
	// });

	if ($("[id*=datapicker]").length) {
		iniciarCalendario("datapicker");

		$("[id*=datapicker]").click(function () {
			alternarEstadoCalendario('datapicker');
		});
	}
});
