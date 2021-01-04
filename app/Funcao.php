<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

    protected $connection = 'dmais';
	protected $table = 'funcao';
	protected $primaryKey = 'id';

    const CREATED_AT = 'Dt_Inclusao';
    const UPDATED_AT = 'Dt_Alteracao';

    public function permissao()
    {
        return $this->belongsToMany(Permissao::class, "permissao_funcao", 'Id_Funcao', 'Id_Permissao')->using(Permissao_funcao::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuarios::class, "users_funcao", 'Id_Funcao', 'Id_User')->using(Usuario_funcao::class);
    }
}
