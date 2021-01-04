<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produtos extends Model
{
    use SoftDeletes;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'produtos';
    protected $primaryKey = 'pro_id';
    protected $fillable = ['pro_nome', 'pro_descricao'];
    protected $dates = ['pro_deletado_em'];

    const CREATED_AT = 'pro_criado_em';
    const UPDATED_AT = 'pro_atualizado_em';
    const DELETED_AT = 'pro_deletado_em';

    // public function empresa()
    // {
    //     return $this->belongsToMany(Empresas::class, 'produto_cliente', 'Id_Produto', 'Id_Cliente')->using(Produto_empresa::class);
    // }

    public function tickets()
    {
        return $this->belongsToMany(Tickets::class, 'ticket_produto', 'pro_fk', 'tic_fk')->using(Ticket_produto::class);
    }


    // public function tickets()
    // {

    //     return $this->belongsToMany(Tickets::class, 'ticket_empresa', 'emp_fk', 'tic_fk')->using(Ticket_empresa::class);
    // }

    // public function scopeVivo($query)
    // {
    //     return $query->where([ ['Razao_Social', 'LIKE', 'Vivo%'], ['Id_Situacao', 1] ])->get();
    // }


	// /**
 //    * The table associated with the model.
 //    *
 //    * @var string
 //    */

	// protected $table = 'produtos';
	// protected $primaryKey = 'pro_id';

	// const CREATED_AT = 'pro_criado_em';
	// const UPDATED_AT = 'pro_atualizado_em';

	// public function tickets()
 //    {
 //        return $this->belongsToMany(Tickets::class, 'ticket_produto', 'tic_fk', 'pro_fk')->using(Ticket_produto::class);
 //    	// return $this->hasMany(Tickets::class, 'tic_fk_produto');
 //    }
}
