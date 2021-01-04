<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicoAlvo extends Model
{
	use SoftDeletes;

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'publicos_alvos';
	protected $primaryKey = 'pua_id';
	protected $fillable = ['pua_nome', 'pua_descricao'];
	protected $dates = ['pua_deletado_em'];

	const CREATED_AT = 'pua_criado_em';
	const UPDATED_AT = 'pua_atualizado_em';
    const DELETED_AT = 'pua_deletado_em';

	public function tickets()
	{
		return $this->belongsToMany(Tickets::class, 'ticket_publico_alvo', 'pua_fk', 'tic_fk')->using(Ticket_empresa::class);
	}
}
