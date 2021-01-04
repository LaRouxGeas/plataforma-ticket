<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Auth;
use Session;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Sai da Sessão
     *
     * @return void
     */
    public function sair()
    {
        Session::flush();
        Auth::logout();
        return redirect()->away('/login');
    }

    /**
     * Retorna a lista de solicitantes.
     *
     * @return $solicitantes
     */
    public function solicitantes()
    {
        $solicitantes = Usuarios::whereHas('funcao.permissao', function($q) {
            $q->where('permissao.Nome', 'PTTGCC_SOLICITANTE');
        })->get();
        return $solicitantes;
    }

    /**
     * Retorna a lista de aprovadores.
     *
     * @return $aprovadores
     */
    public function aprovadores()
    {
        $aprovadores = Usuarios::whereHas('funcao.permissao', function($q) {
            $q->where('permissao.Nome', 'PTTGCC_APROVADOR');
        })->get();
        return $aprovadores;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\USUARIO  $uSUARIO
     * @return \Illuminate\Http\Response
     */
    public function show(USUARIO $uSUARIO)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\USUARIO  $uSUARIO
     * @return \Illuminate\Http\Response
     */
    public function edit(USUARIO $uSUARIO)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\USUARIO  $uSUARIO
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, USUARIO $uSUARIO)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\USUARIO  $uSUARIO
     * @return \Illuminate\Http\Response
     */
    public function destroy(USUARIO $uSUARIO)
    {
        //
    }
}
