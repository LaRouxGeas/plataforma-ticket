<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketValidacao;
use Storage;
use App\Tickets;
use App\PublicoAlvo;
use App\Produtos;
use App\Comunicacoes;
use App\Regioes;
use App\Empresas;
use App\Usuarios;
use App\Estados;
use Illuminate\Support\Facades\Auth;
use App\Arquivos;
use App\Mail\EnviarEmail;
use Illuminate\Support\Facades\Mail;
use Validator;

class TicketController extends Controller
{

    public function inicio(Request $request)
    {
        $email = $request->email;
        $pass = base64_decode($request->pass);

        Auth::attempt(['email' => $email, 'password' => $pass]);

        $request->session()->put([
            'password_hash' => $request->user()->getAuthPassword(),
        ]);

        if (Auth::user()->id){
            return redirect("/ticket");
        }

    }

    public function teste()
    {
        return view('inc.teste');
        // $senha = ['senha' => 'gcc@321'];
        // $menssagens = [
        //     'senha.required' => 'A :attribute é obrigatória.',
        //     'senha.min' => 'A :attribute deve ter no mínimo :min.',
        //     'senha.regex' => 'A :attribute deve conter letras maiúsculas, minúsculas e números.',
        // ];
        // $validar = Validator::make($senha, [
        // 'senha' => ['required', 'min:6', 'regex:/^.*(?=.*[a-zà-ú])(?=.*[A-ZÀ-Ú])(?=.*[0-9]).*$/'],
        // ],$menssagens);

        // return dd($validar->errors()->all());
        // // $teste = "  vIVO   5  ";
        // $teste = 'Abcdefghij';
        // $teste = preg_replace('/\s+/', '', trim($teste) );
        // $teste = ucfirst(mb_strtolower($teste));
        // // $dbteste = "Vivo1";
        // $dbteste = "Abcdefghik";
        // $aaa = similar_text($teste, $dbteste, $awo);

        // // preg_replace('/\s+/', ' ', $foo);
        // // ucfirst()
        // return $aaa;
    }

    /**
     * Seus Tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ticket.index');
    }

    /**
     * Lita de todos os tickets, só aprovadores.
     *
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        return view('ticket.lista');
    }

    /**
     * Pesquisa de tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function pesquisar()
    {
        return view('ticket.pesquisar');
    }

    public function solicitacoes()
    {
        $ticket = Tickets::with('autor', 'aprovador', 'estado', 'arquivos');
        if (!(auth()->user()->verificaFuncao(['Aprovador PTTGCC  (Função Funcionário Interno GCC)', 'Visualizador  PTTGCC (Ambos)'])) ) {
            $ticket = $ticket->where('tic_fk_autor', auth()->id());
        }
        return $ticket->paginate(10);
    }

    public function pesquisa()
    {
        $id = request()->ticId;
        $titulo = request()->ticTitulo;
        $solicitantes = request()->ticSolicitante;
        $aprovadores = request()->ticAprovador;
        $dtsCriacao = request()->ticCriado;
        $dtsAtualizacao = request()->ticAtualizado;
        $status = request()->ticStatus;
        $anexos = request()->ticArquivos;

        $pesquisa = Tickets::with('autor', 'aprovador', 'estado', 'arquivos');

        if (!(auth()->user()->verificaFuncao(['Aprovador PTTGCC  (Função Funcionário Interno GCC)', 'Visualizador  PTTGCC (Ambos)'])) ) {
            $pesquisa = $pesquisa->where('tic_fk_autor', auth()->id());
        }

        if (!is_null($id)) {
            $pesquisa = $pesquisa->where('tic_id', $id);
        }

        if (!is_null($titulo)) {
            $pesquisa = $pesquisa->where('tic_titulo', 'LIKE' ,'%'.$titulo.'%');
        }

        if (!is_null($solicitantes)) {
            $pesquisa = $pesquisa->whereIn('tic_fk_autor', $solicitantes);
        }

        if (!is_null($aprovadores)) {
            $pesquisa = $pesquisa->whereIn('tic_fk_avaliador', $aprovadores);
        }

        if (!is_null($dtsCriacao)) {
            if(self::ValidaDatas($dtsCriacao)) {
                $data = explode("|", $dtsCriacao);

                $dataInicial = self::ArrumarData($data[0], 1);
                $dataFinal = self::ArrumarData($data[1], 0);

                $pesquisa = $pesquisa->whereBetween("tic_criado_em", [$dataInicial, $dataFinal]);
            }
        }

        if (!is_null($dtsAtualizacao)) {
            if(self::ValidaDatas($dtsAtualizacao)) {
                $data = explode("|", $dtsAtualizacao);

                $dataInicial = self::ArrumarData($data[0], 1);
                $dataFinal = self::ArrumarData($data[1], 0);

                $pesquisa = $pesquisa->whereBetween("tic_atualizado_em", [$dataInicial, $dataFinal]);
            }
        }

        if (!is_null($status)) {
            $pesquisa = $pesquisa->whereIn('tic_fk_estado', $status);
        }

        if (!is_null($anexos)) {
            if ($anexos == true) {
                $pesquisa = $pesquisa->has('arquivos');
            } elseif ($anexos == false) {
                $pesquisa = $pesquisa->doesntHave('arquivos');
            }
        }

        $pesquisa = $pesquisa->orderBy('tic_id', 'ASC')->paginate(10);
        return $pesquisa;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arquivosTemporarios = Arquivos::temporarios(auth()->id());
        $publicosAlvos = PublicoAlvo::orderBy('pua_nome')->get();
        $produtos = Produtos::orderBy('pro_nome')->get();
        $comunicacoes = Comunicacoes::orderBy('com_nome')->get();
        $regioes = Regioes::orderBy('reg_nome')->get();
        $empresas = Empresas::orderBy('emp_nome')->get();
        $aprovadores = Usuarios::whereHas('funcao.permissao', function($q) {
            $q->where('permissao.Nome', 'PTTGCC_APROVADOR');
        })->orderBy('name')->get();

        return view('ticket.create', [
            'temporarios'       => $arquivosTemporarios,
            'publicosAlvos'     => $publicosAlvos,
            'produtos'          => $produtos,
            'comunicacoes'      => $comunicacoes,
            'regioes'           => $regioes,
            'empresas'          => $empresas,
            'aprovadores'       => $aprovadores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketValidacao $request)
    {
        $arquivosTemporarios = Arquivos::temporarios(auth()->id());
        if (strtolower(request('enviar')) === "salvar rascunho") {
            $ticket = Tickets::create([
                'tic_titulo' => request('tic_titulo'),
                'tic_descricao' => request('tic_descricao'),
                'tic_fk_autor' => auth()->id(),
                'tic_fk_avaliador' => request('fk_aprovador'),
                'tic_fk_estado' => 1,
                'tic_observacao_solicitante' => request('tic_obs_solicitante'),
                'tic_validade' => date("Y-m-d", strtotime(str_replace('/', '-', request('tic_validade') ))),
            ]);

            $ticket->adicionarArquivos($arquivosTemporarios);

            !request(['comunicacoes']) ?: $ticket->comunicacao()->attach(request()->comunicacoes);
            !request(['empresas']) ?: $ticket->empresa()->attach(request()->empresas);
            !request(['regioes']) ?: $ticket->regiao()->attach(request()->regioes);
            !request(['produtos']) ?: $ticket->produto()->attach(request()->produtos);
            !request(['publicosAlvos']) ?: $ticket->publicoAlvo()->attach(request()->publicosAlvos);

        } elseif (strtolower(request('enviar')) === "enviar ticket") {
            $ticket = Tickets::create([
                'tic_titulo' => request('tic_titulo'),
                'tic_descricao' => request('tic_descricao'),
                'tic_fk_autor' => auth()->id(),
                'tic_fk_avaliador' => request('fk_aprovador'),
                'tic_fk_estado' => 2,
                'tic_observacao_solicitante' => request('tic_obs_solicitante'),
                'tic_validade' => date("Y-m-d", strtotime(str_replace('/', '-', request('tic_validade') ))),
            ]);

            $ticket->adicionarArquivos($arquivosTemporarios);

            $ticket->comunicacao()->attach(request()->comunicacoes);
            $ticket->empresa()->attach(request()->empresas);
            $ticket->regiao()->attach(request()->regioes);
            $ticket->produto()->attach(request()->produtos);
            $ticket->publicoAlvo()->attach(request()->publicosAlvos);
        }

        return redirect('/ticket');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Tickets $ticket)
    {
        $publicosAlvos = PublicoAlvo::with('tickets')->orderBy('pua_nome')->get();
        $produtos = Produtos::with('tickets')->orderBy('pro_nome')->get();
        $comunicacoes = Comunicacoes::with('tickets')->orderBy('com_nome')->get();
        $regioes = Regioes::with('tickets')->orderBy('reg_nome')->get();
        $empresas = Empresas::with('tickets')->orderBy('emp_nome')->get();
        $aprovadores = Usuarios::whereHas('funcao.permissao', function($q) {
            $q->where('permissao.Nome', 'PTTGCC_APROVADOR');
        })->orderBy('name')->get();

        return view('ticket.show', [
            'ticket'            => $ticket,
            'publicosAlvos'     => $publicosAlvos,
            'produtos'          => $produtos,
            'comunicacoes'      => $comunicacoes,
            'regioes'           => $regioes,
            'empresas'          => $empresas,
            'aprovadores'       => $aprovadores
        ]);
    }

    /**
     * Cancela um Ticket e gurada o comentario do solicitante.
     *
     * @param  \App\Tickets  $ticket
     * @return \Illuminate\Http\Response
     */
    public function cancelar(Tickets $ticket)
    {
        if ($ticket->tic_fk_estado == 1 || $ticket->tic_fk_estado == 2) {
            $ticket->update([
                'tic_fk_estado' => 6,
                'tic_observacao_solicitante' => request('tic_obs_solicitante'),
            ]);
        }

        return redirect('/ticket');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Tickets $ticket)
    {
        $arquivosTemporarios = Arquivos::temporarios(auth()->id());
        $publicosAlvos = PublicoAlvo::with('tickets')->orderBy('pua_nome')->get();
        $produtos = Produtos::with('tickets')->orderBy('pro_nome')->get();
        $comunicacoes = Comunicacoes::with('tickets')->orderBy('com_nome')->get();
        $regioes = Regioes::with('tickets')->orderBy('reg_nome')->get();
        $empresas = Empresas::with('tickets')->orderBy('emp_nome')->get();
        $aprovadores = Usuarios::whereHas('funcao.permissao', function($q) {
            $q->where('permissao.Nome', 'PTTGCC_APROVADOR');
        })->orderBy('name')->get();

        return view('ticket.edit', [
            'ticket'            => $ticket,
            'temporarios'       => $arquivosTemporarios,
            'publicosAlvos'     => $publicosAlvos,
            'produtos'          => $produtos,
            'comunicacoes'      => $comunicacoes,
            'regioes'           => $regioes,
            'empresas'          => $empresas,
            'aprovadores'       => $aprovadores
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(TicketValidacao $request, Tickets $ticket)
    {
        $arquivosTemporarios = Arquivos::temporarios(auth()->id());
        if (strtolower(request('enviar')) === "salvar rascunho") {
            $ticket->update([
                'tic_titulo' => request('tic_titulo'),
                'tic_descricao' => request('tic_descricao'),
                'tic_fk_autor' => auth()->id(),
                'tic_fk_avaliador' => request('fk_aprovador'),
                'tic_fk_estado' => 1,
                'tic_observacao_solicitante' => request('tic_obs_solicitante'),
                'tic_validade' => date("Y-m-d", strtotime(str_replace('/', '-', request('tic_validade') ))),
            ]);

            $ticket->adicionarArquivos($arquivosTemporarios);

            !request(['comunicacoes']) ? $ticket->comunicacao()->detach() : $ticket->comunicacao()->sync(request()->comunicacoes);
            !request(['empresas']) ? $ticket->empresa()->detach() : $ticket->empresa()->sync(request()->empresas);
            !request(['regioes']) ? $ticket->regiao()->detach() : $ticket->regiao()->sync(request()->regioes);
            !request(['produtos']) ? $ticket->produto()->detach() : $ticket->produto()->sync(request()->produtos);
            !request(['publicosAlvos']) ? $ticket->publicoAlvo()->detach() : $ticket->publicoAlvo()->sync(request()->publicosAlvos);

        } elseif (strtolower(request('enviar')) === "enviar ticket") {
            $ticket->update([
                'tic_titulo' => request('tic_titulo'),
                'tic_descricao' => request('tic_descricao'),
                'tic_fk_autor' => auth()->id(),
                'tic_fk_avaliador' => request('fk_aprovador'),
                'tic_fk_estado' => 2,
                'tic_observacao_solicitante' => request('tic_obs_solicitante'),
                'tic_validade' => date("Y-m-d", strtotime(str_replace('/', '-', request('tic_validade') ))),
            ]);

            $ticket->adicionarArquivos($arquivosTemporarios);

            $ticket->comunicacao()->sync(request()->comunicacoes);
            $ticket->empresa()->sync(request()->empresas);
            $ticket->regiao()->sync(request()->regioes);
            $ticket->produto()->sync(request()->produtos);
            $ticket->publicoAlvo()->sync(request()->publicosAlvos);

        } elseif (strtolower(request('enviar')) === "cancelar ticket") {
            $ticket->update([
                'tic_titulo' => request('tic_titulo'),
                'tic_descricao' => request('tic_descricao'),
                'tic_fk_autor' => auth()->id(),
                'tic_fk_avaliador' => request('fk_aprovador'),
                'tic_fk_estado' => 6,
                'tic_observacao_solicitante' => request('tic_obs_solicitante'),
                'tic_validade' => date("Y-m-d", strtotime(str_replace('/', '-', request('tic_validade') ))),
            ]);

            Arquivos::deletarTemporarios();

            $ticket->comunicacao()->sync(request()->comunicacoes);
            $ticket->empresa()->sync(request()->empresas);
            $ticket->regiao()->sync(request()->regioes);
            $ticket->produto()->sync(request()->produtos);
            $ticket->publicoAlvo()->sync(request()->publicosAlvos);
        }

        return redirect('/ticket');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function revisar(Tickets $ticket)
    {
        $publicosAlvos = PublicoAlvo::with('tickets')->orderBy('pua_nome')->get();
        $produtos = Produtos::with('tickets')->orderBy('pro_nome')->get();
        $comunicacoes = Comunicacoes::with('tickets')->orderBy('com_nome')->get();
        $regioes = Regioes::with('tickets')->orderBy('reg_nome')->get();
        $empresas = Empresas::with('tickets')->orderBy('emp_nome')->get();
        $aprovadores = Usuarios::whereHas('funcao.permissao', function($q) {
            $q->where('permissao.Nome', 'PTTGCC_APROVADOR');
        })->orderBy('name')->get();

        !($ticket->tic_fk_estado == 2) ?: $ticket->paraAnalise();

        return view('ticket.revisar', [
            'ticket'            => $ticket,
            'publicosAlvos'     => $publicosAlvos,
            'produtos'          => $produtos,
            'comunicacoes'      => $comunicacoes,
            'regioes'           => $regioes,
            'empresas'          => $empresas,
            'aprovadores'       => $aprovadores
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function aprovar(Tickets $ticket)
    {
        if (strtolower(request('enviar')) === "aprovado") {
            $ticket->update([
                'tic_fk_estado' => 4,
                'tic_observacao_aprovador' => request('tic_obs_aprovador'),
            ]);
        } elseif (strtolower(request('enviar')) === "não aprovado") {
            $ticket->update([
                'tic_fk_estado' => 5,
                'tic_observacao_aprovador' => request('tic_obs_aprovador'),
            ]);
        } elseif (strtolower(request('enviar')) === "salvar") {
            $ticket->update([
                'tic_observacao_aprovador' => request('tic_obs_aprovador'),
            ]);
        }
        return redirect('/ticket');
    }

    /**
     * Enviar Emails
     *
     * @return
     */
    public function email()
    {
        // $usuario = Usuarios::find(Auth::user()->id);
        // dd($usuario);
        // return view('emails.teste', ['usuario' => $usuario]);
        // Mail::to('36b478124d-684466@inbox.mailtrap.io')->send(new EnviarEmail($usuario));
        return redirect('/ticket');
    }

    public function similaridade(Request $request)
    {
        $nome = $request->nomeOutro;
        $tabela = $request->nomeTabela;

        $nome = preg_replace('/\W+/', '', trim($nome));
        $nome = mb_strtolower($nome);

        if ($tabela === "comunicacoes") {
            $itens = Comunicacoes::orderBy('com_nome')->get()->pluck('com_nome');
        } elseif ($tabela === "empresas") {
            $itens = Empresas::orderBy('emp_nome')->get()->pluck('emp_nome');
        } elseif ($tabela === "regioes") {
            $itens = Regioes::orderBy('reg_nome')->get()->pluck('reg_nome');
        } elseif ($tabela === "produtos") {
            $itens = Produtos::orderBy('pro_nome')->get()->pluck('pro_nome');
        } elseif ($tabela === "publicosAlvos") {
            $itens = PublicoAlvo::orderBy('pua_nome')->get()->pluck('pua_nome');
        }

        foreach ($itens as $item) {
            similar_text($nome, preg_replace('/\W+/', '', mb_strtolower($item)), $porcentagem);
            if ($porcentagem >= 50) {
                return response()->json([$item], 200);
            }
        }
        return response()->json(['erro' => 'Nenhum nome igual foi achado!'], 422);
    }

    function ValidaDatas($datas) {
        if ($datas == 0 || $datas == null) {
            return false;
        }

        $data = explode("|","$datas");
        $dataInicial = explode("/","$data[0]");
        $dataFinal = explode("/","$data[1]");

        $dI = $dataInicial[0];
        $mI = $dataInicial[1];
        $yI = $dataInicial[2];

        $dF = $dataFinal[0];
        $mF = $dataFinal[1];
        $yF = $dataFinal[2];

        if (checkdate($mI,$dI,$yI) && checkdate($mF,$dF,$yF) ) {
            return true;
        }
        return false;
    }

    function ArrumarData($dataRecebida, $inicial) {
        $data = explode("/",$dataRecebida);

        if ($inicial == 1) {
            $dataCorrigida = $data[2]."-".$data[1]."-".$data[0]." 00:00:00";
        } else {
            $dataCorrigida = $data[2]."-".$data[1]."-".$data[0]." 23:59:59";
        }

        return $dataCorrigida;
    }
}
