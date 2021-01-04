<?php

namespace App\Http\Controllers;

use App\Regioes;
use Illuminate\Http\Request;

class RegiaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regioes = Regioes::withTrashed()->orderBy('reg_nome')->get();

        return view('regiao.index', ['regioes' => $regioes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('regiao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regiao = request()->validate([
            'reg_nome' => 'required|min:3',
            'reg_descricao' => 'required'
        ],[
            'reg_nome.required' => 'O nome é um campo obrigatório!',
            'reg_nome.min' => 'O nome deve ter no mínimo :min caracteres!',
            'reg_descricao.required' => 'A descricao é um campo obrigatório!',
        ]);

        $regiao['reg_nome'] = capitalize($regiao['reg_nome']);
        Regioes::create($regiao);

        return redirect('/regiao');
    }

    /**
     * Cria e retorna o registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Regioes  $regiao
     */
    public function outros(Request $request)
    {
        $regiao = request()->validate([
            'reg_nome' => 'required|min:3',
            'reg_descricao' => 'required'
        ],[
            'reg_nome.required' => 'O nome é um campo obrigatório!',
            'reg_nome.min' => 'O nome deve ter no mínimo :min caracteres!',
            'reg_descricao.required' => 'A descricao é um campo obrigatório!',
        ]);

        $regiao['reg_nome'] = capitalize($regiao['reg_nome']);
        return Regioes::create($regiao);
    }

    /**
     * Display the specified resource delete warning.
     *
     * @param  \App\Regioes  $regiao
     * @return \Illuminate\Http\Response
     */
    public function delete(Regioes $regiao)
    {
        return view('regiao.delete', compact('regiao'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Regioes  $regiao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regioes $regiao)
    {
        $regiao->delete();

        return redirect('/regiao');
    }
}
