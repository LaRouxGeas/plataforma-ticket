<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Arquivos extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

    protected $connection = 'mysql';
	protected $table = 'arquivos';
	protected $primaryKey = 'arq_id';
    protected $fillable = ['arq_nome', 'arq_local', 'arq_extensao', 'arq_mime', 'arq_tamanho', 'arq_fk_usuario', 'arq_fk_ticket'];

	const CREATED_AT = 'arq_criado_em';
	const UPDATED_AT = 'arq_atualizado_em';

	public function ticket()
    {
    	return $this->belongsTo(Tickets::class, 'arq_fk_ticket');
    }

    public function dono()
    {
        return $this->belongsTo(Usuarios::class, 'arq_fk_usuario');
    }

    public static function temporarios($usuario)
    {
        return Arquivos::where([ ['arq_fk_ticket', null], ['arq_fk_usuario', $usuario] ])->get();
    }

    public static function deletarTemporarios()
    {
        $arquivosTemporarios = Arquivos::temporarios(auth()->id());
        foreach ($arquivosTemporarios as $arquivo) {
            Storage::delete($arquivo->arq_local);
            $arquivo->delete();
        }
    }

    public static function gerarNome($nome, $extensao)
    {
        $nome_extensao = pathinfo($nome, PATHINFO_FILENAME);
        $extensao = strtolower($extensao);
        $i = 1;

        if (Storage::disk('public')->exists($nome_extensao.'.'.$extensao)) {
            while ( Storage::disk('public')->exists($nome_extensao.'('.$i.').'.$extensao)) {
                $i++;
            }
            return $nome_extensao.'('.$i.').'.$extensao;
        } else {
            return $nome;
        }
    }
}
