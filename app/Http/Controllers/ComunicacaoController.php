<?php

namespace App\Http\Controllers;

use App\Comunicacoes;
use Illuminate\Http\Request;

class ComunicacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunicacoes = Comunicacoes::withTrashed()->orderBy('com_nome')->get();

        return view('comunicacao.index', ['comunicacoes' => $comunicacoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comunicacao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comunicacao = request()->validate([
            'com_nome' => 'required|min:3',
            'com_descricao' => 'required'
        ],[
            'com_nome.required' => 'O nome é um campo obrigatório!',
            'com_nome.min' => 'O nome deve ter no mínimo :min caracteres!',
            'com_descricao.required' => 'A descricao é um campo obrigatório!',
        ]);

        $comunicacao['com_nome'] = capitalize($comunicacao['com_nome']);
        Comunicacoes::create($comunicacao);

        return redirect('/comunicacao');
    }

    /**
     * Cria e retorna o registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Comunicacoes  $comunicacao
     */
    public function outros(Request $request)
    {
        $comunicacao = request()->validate([
            'com_nome' => 'required|min:3',
            'com_descricao' => 'required'
        ],[
            'com_nome.required' => 'O nome é um campo obrigatório!',
            'com_nome.min' => 'O nome deve ter no mínimo :min caracteres!',
            'com_descricao.required' => 'A descricao é um campo obrigatório!',
        ]);

        $comunicacao['com_nome'] = capitalize($comunicacao['com_nome']);
        return Comunicacoes::create($comunicacao);
    }

    /**
     * Display the specified resource delete warning.
     *
     * @param  \App\Comunicacoes  $comunicacao
     * @return \Illuminate\Http\Response
     */
    public function delete(Comunicacoes $comunicacao)
    {
        return view('comunicacao.delete', compact('comunicacao'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comunicacoes  $comunicacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comunicacoes $comunicacao)
    {
        $comunicacao->delete();

        return redirect('/comunicacao');
    }
}
