<?php

namespace App\Http\Controllers;

use App\Estados;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Estados::all();
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
     * @param  \App\ESTADO  $eSTADO
     * @return \Illuminate\Http\Response
     */
    public function show(ESTADO $eSTADO)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ESTADO  $eSTADO
     * @return \Illuminate\Http\Response
     */
    public function edit(ESTADO $eSTADO)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ESTADO  $eSTADO
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ESTADO $eSTADO)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ESTADO  $eSTADO
     * @return \Illuminate\Http\Response
     */
    public function destroy(ESTADO $eSTADO)
    {
        //
    }
}
