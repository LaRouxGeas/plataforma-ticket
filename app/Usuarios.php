<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Authenticatable
{
    use Notifiable;

	/**
    * The table associated with the model.
    *
    * @var string
    */

    protected $connection = 'dmais';
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ticketsSolicitante()
    {
        return $this->hasMany(Tickets::class, 'tic_fk_autor');
    }

    public function ticketsAprovador()
    {
        return $this->hasMany(Tickets::class, 'tic_fk_avaliador');
        // return $this->belongsToMany(Tickets::class, 'ticket_usuarios', 'usu_fk', 'tic_fk')->using(Ticket_empresa::class);
    }

    public function funcao()
    {
        return $this->belongsToMany(Funcao::class, "users_funcao", 'Id_User', 'Id_Funcao')->using(Usuario_funcao::class);
    }

    public function arquivos()
    {
        return $this->hasMany(Arquivos::class, 'arq_fk_usuario');
    }

    public function permissao()
    {
        return $this->funcao->contains('Descricao','Autor PTT');
    }

    public function verificaFuncao($valor)
    {
        if (is_array($valor)) {
            return !empty(array_intersect($this->funcao()->pluck('Descricao')->toArray(), $valor));
        }

        $this->funcao->contains($valor);
    }
}
