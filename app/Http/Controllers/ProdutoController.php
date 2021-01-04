<?php

namespace App\Http\Controllers;

use App\Produtos;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produtos::withTrashed()->orderBy('pro_nome')->get();

        return view('produto.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produto = request()->validate([
            'pro_nome' => 'required|min:3',
            'pro_descricao' => 'required',
        ], [
            'pro_nome.required' => 'O nome é um campo obrigatório!',
            'pro_nome.min' => 'O nome deve ter no mínimo :min caracteres!',
            'pro_descricao.required' => 'A descricao é um campo obrigatório!',
        ]);

        $produto['pro_nome'] = capitalize($produto['pro_nome']);
        Produtos::create($produto);

        return redirect('/produto');
    }

    /**
     * Cria e retorna o registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Produtos  $produto
     */
    public function outros(Request $request)
    {
        $produto = request()->validate([
            'pro_nome' => 'required|min:3',
            'pro_descricao' => 'required',
        ], [
            'pro_nome.required' => 'O nome é um campo obrigatório!',
            'pro_nome.min' => 'O nome deve ter no mínimo :min caracteres!',
            'pro_descricao.required' => 'A descricao é um campo obrigatório!',
        ]);

        $produto['pro_nome'] = capitalize($produto['pro_nome']);
        return Produtos::create($produto);
    }

    /**
     * Display the specified resource delete warning.
     *
     * @param  \App\Produtos  $$produto
     * @return \Illuminate\Http\Response
     */
    public function delete(Produtos $produto)
    {
        return view('produto.delete', compact('produto'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produtos  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produtos $produto)
    {
        $produto->delete();

        return redirect('/produto');
    }
}
