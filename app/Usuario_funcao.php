<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Usuario_funcao extends Pivot
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

    protected $connection = 'dmais';
	protected $table = 'users_funcao';
	protected $primaryKey = 'id';

	public $timestamps = false;
}
