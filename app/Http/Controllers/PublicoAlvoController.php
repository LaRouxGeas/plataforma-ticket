<?php

namespace App\Http\Controllers;

use App\PublicoAlvo;
use Illuminate\Http\Request;

class PublicoAlvoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicos_alvos = PublicoAlvo::withTrashed()->orderBy('pua_nome')->get();

        return view('publico_alvo.index', ['publicos_alvos' => $publicos_alvos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publico_alvo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $publico_alvo = request()->validate([
            'pua_nome' => 'required',
            'pua_descricao' => 'required'
        ],[
            'pua_nome.required' => 'O nome é um campo obrigatório!',
            'pua_descricao.required' => 'A descricao é um campo obrigatório!',

        ]);

        $publico_alvo['pua_nome'] = capitalize($publico_alvo['pua_nome']);
        PublicoAlvo::create($publico_alvo);

        return redirect('/publico_alvo');
    }

    /**
     * Cria e retorna o registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\PublicoAlvo  $publico_alvo
     */
    public function outros(Request $request)
    {
        $publico_alvo = request()->validate([
            'pua_nome' => 'required',
            'pua_descricao' => 'required'
        ],[
            'pua_nome.required' => 'O nome é um campo obrigatório!',
            'pua_descricao.required' => 'A descricao é um campo obrigatório!',

        ]);

        $publico_alvo['pua_nome'] = capitalize($publico_alvo['pua_nome']);
        return PublicoAlvo::create($publico_alvo);
    }

    /**
     * Display the specified resource delete warning.
     *
     * @param  \App\PublicoAlvo  $publico_alvo
     * @return \Illuminate\Http\Response
     */
    public function delete(PublicoAlvo $publico_alvo)
    {
        return view('publico_alvo.delete', compact('publico_alvo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PublicoAlvo  $publico_alvo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicoAlvo $publico_alvo)
    {
        $publico_alvo->delete();

        return redirect('/publico_alvo');
    }
}
