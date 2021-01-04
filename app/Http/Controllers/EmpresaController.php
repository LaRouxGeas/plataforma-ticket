<?php

namespace App\Http\Controllers;

use App\Empresas;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresas::withTrashed()->orderBy('emp_nome')->get();

        return view('empresa.index', ['empresas' => $empresas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresa = request()->validate([
            'emp_nome' => 'required|min:3',
            'emp_descricao' => 'required'
        ],[
            'emp_nome.required' => 'O nome é um campo obrigatório!',
            'emp_nome.min' => 'O nome deve ter no mínimo :min caracteres!',
            'emp_descricao.required' => 'A descricao é um campo obrigatório!',
        ]);

        $empresa['emp_nome'] = capitalize($empresa['emp_nome']);
        Empresas::create($empresa);

        return redirect('/empresa');
    }

    /**
     * Cria e retorna o registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Empresas  $empresa
     */
    public function outros(Request $request)
    {
        $empresa = request()->validate([
            'emp_nome' => 'required|min:3',
            'emp_descricao' => 'required'
        ],[
            'emp_nome.required' => 'O nome é um campo obrigatório!',
            'emp_nome.min' => 'O nome deve ter no mínimo :min caracteres!',
            'emp_descricao.required' => 'A descricao é um campo obrigatório!',
        ]);

        $empresa['emp_nome'] = capitalize($empresa['emp_nome']);
        return Empresas::create($empresa);
    }

    /**
     * Display the specified resource delete warning.
     *
     * @param  \App\Empresas  $empresa
     * @return \Illuminate\Http\Response
     */
    public function delete(Empresas $empresa)
    {
        return view('empresa.delete', compact('empresa'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresas  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresas $empresa)
    {
        $empresa->delete();

        return redirect('/empresa');
    }
}
