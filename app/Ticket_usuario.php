<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket_usuario extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

	protected $table = 'ticket_usuarios';

	public $timestamps = false;
}
