<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
	/**
    * The table associated with the model.
    *
    * @var string
    */

	protected $table = 'estados';
	protected $primaryKey = 'est_id';

	const CREATED_AT = 'est_criado_em';
	const UPDATED_AT = 'est_atualizado_em';

	public function tickets()
    {
    	return $this->hasMany(Tickets::class, 'tic_fk_estado');
    }
}
