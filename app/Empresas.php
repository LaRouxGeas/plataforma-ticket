<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresas extends Model
{
    use SoftDeletes;

    /**
    * The table associated with the model.
    *
    * @var string
    */

	protected $table = 'empresas';
    protected $primaryKey = 'emp_id';
    protected $fillable = ['emp_nome', 'emp_descricao'];
    protected $dates = ['emp_deletado_em'];

    const CREATED_AT = 'emp_criado_em';
    const UPDATED_AT = 'emp_atualizado_em';
    const DELETED_AT = 'emp_deletado_em';

	public function tickets()
    {
        return $this->belongsToMany(Tickets::class, 'ticket_empresa', 'emp_fk', 'tic_fk')->using(Ticket_empresa::class);
    }

    // public function produto()
    // {
    //     return $this->belongsToMany(Produtos::class, 'produto_cliente', 'Id_Cliente', 'Id_Produto')->using(Produto_empresa::class);
    // }

    // public function scopeVivo($query)
    // {
    // 	return $query->where([ ['Razao_Social', 'LIKE', 'Vivo%'], ['Id_Situacao', 1] ])->get();
    // }
}
