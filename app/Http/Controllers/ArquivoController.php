<?php

namespace App\Http\Controllers;

use Storage;
use App\Arquivos;
use App\Tickets;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\ArquivoValidacao;

class ArquivoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArquivoValidacao $request)
    {
        // return strtolower(request()->arquivo->getClientMimeType());
        $nome = Arquivos::gerarNome(request()->arquivo->getClientOriginalName(), request()->arquivo->getClientOriginalExtension());

        $arquivo = Arquivos::create([
            'arq_nome' => $nome,
            'arq_local' => 'public/'.$nome,
            'arq_extensao' => strtolower(request()->arquivo->getClientOriginalExtension()),
            'arq_mime' => request()->arquivo->getClientMimeType(),
            'arq_tamanho' => request()->file('arquivo')->getSize(),
            'arq_fk_usuario' => auth()->id(),
        ]);

        Storage::put($arquivo->arq_local, file_get_contents(request()->arquivo));

        $arquivo->local_dinamico = Storage::url($arquivo->arq_local);

        return $arquivo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Arquivos  $arquivo
     * @return \Illuminate\Http\Response
     */
    public function download(Arquivos $arquivo)
    {
        return response()->download(storage_path("app/public/".$arquivo->arq_nome));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\arquivo  $arquivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arquivos $arquivo)
    {
        Storage::delete($arquivo->arq_local);

        $arquivo->delete();

        return "ok";
    }
}
