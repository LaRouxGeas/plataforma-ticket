<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Permissao_funcao extends Pivot
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

    protected $connection = 'dmais';
	protected $table = 'permissao_funcao';
	protected $primaryKey = 'id';

	public $timestamps = false;
}
