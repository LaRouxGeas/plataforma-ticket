<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regioes extends Model
{
    use SoftDeletes;
    
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $fillable = ['reg_nome', 'reg_descricao'];

	protected $table = 'regioes';
	protected $primaryKey = 'reg_id';
    protected $dates = ['reg_deletado_em'];

    const CREATED_AT = 'reg_criado_em';
    const UPDATED_AT = 'reg_atualizado_em';
    const DELETED_AT = 'reg_deletado_em';

	public function tickets()
    {
        return $this->belongsToMany(Tickets::class, 'ticket_regiao', 'reg_fk', 'tic_fk')->using(Ticket_regiao::class);
    }
}
