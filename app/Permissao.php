<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

    protected $connection = 'dmais';
	protected $table = 'permissao';
	protected $primaryKey = 'id';

    const CREATED_AT = 'Dt_Inclusao';
    const UPDATED_AT = 'Dt_Alteracao';

    public function funcao()
    {
        return $this->belongsToMany(Funcao::class, "permissao_funcao", 'Id_Permissao', 'Id_Funcao')->using(Permissao_funcao::class);
    }
}
