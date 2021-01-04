<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comunicacoes extends Model
{
    use SoftDeletes;

	/**
    * The table associated with the model.
    *
    * @var string
    */
	protected $table = 'comunicacoes';
	protected $primaryKey = 'com_id';
    protected $fillable = ['com_nome', 'com_descricao'];
    protected $dates = ['com_deletado_em'];

	const CREATED_AT = 'com_criado_em';
	const UPDATED_AT = 'com_atualizado_em';
    const DELETED_AT = 'com_deletado_em';

	public function tickets()
    {
        return $this->belongsToMany(Tickets::class, 'ticket_comunicacao', 'com_fk', 'tic_fk')->using(Ticket_comunicacao::class);
    }
}
