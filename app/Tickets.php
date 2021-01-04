<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
	/**
    * The table associated with the model.
    *
    * @var string
    */

    protected $connection = 'mysql';
	protected $table = 'tickets';
	protected $primaryKey = 'tic_id';
    protected $fillable = ['tic_titulo', 'tic_descricao', 'tic_fk_autor', 'tic_fk_avaliador', 'tic_fk_estado', 'tic_observacao_solicitante', 'tic_observacao_aprovador', 'tic_validade'];
    protected $dates = ['tic_validade'];

	const CREATED_AT = 'tic_criado_em';
	const UPDATED_AT = 'tic_atualizado_em';

    public function autor()
    {
    	return $this->belongsTo(Usuarios::class, 'tic_fk_autor');
    }

    public function aprovador()
    {
        return $this->belongsTo(Usuarios::class, 'tic_fk_avaliador');
        // $database = $this->getConnection("dmais")->getDatabaseName();
        // return $this->belongsToMany(Usuarios::class, "$database.ticket_usuarios", 'tic_fk', 'usu_fk')->using(Ticket_usuario::class);
    }

    public function estado()
    {
    	return $this->belongsTo(Estados::class, 'tic_fk_estado');
    }

    public function arquivos()
    {
    	return $this->hasMany(Arquivos::class, 'arq_fk_ticket');
    }

    public function produto()
    {
        return $this->belongsToMany(Produtos::class, "ticket_produto", 'tic_fk', 'pro_fk')->using(Ticket_produto::class);
    }

    public function regiao()
    {
        return $this->belongsToMany(Regioes::class, 'ticket_regiao', 'tic_fk', 'reg_fk')->using(Ticket_regiao::class);
    }

    public function empresa()
    {
        return $this->belongsToMany(Empresas::class, "ticket_empresa", 'tic_fk', 'emp_fk')->using(Ticket_empresa::class);
    }

    public function publicoAlvo()
    {
        return $this->belongsToMany(PublicoAlvo::class, "ticket_publico_alvo", 'tic_fk', 'pua_fk')->using(Ticket_empresa::class);
    }

    public function comunicacao()
    {
        return $this->belongsToMany(Comunicacoes::class, 'ticket_comunicacao', 'tic_fk', 'com_fk')->using(Ticket_comunicacao::class);
    }

    public function paraAnalise()
    {
        $this->update(['tic_fk_estado' => 3]);
    }

    public function adicionarArquivos($arquivos)
    {
        $this->arquivos()->saveMany($arquivos);
    }
}
