<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Ticket_publico_alvo extends Pivot
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

	protected $table = 'ticket_publico_alvo';

	public $timestamps = false;
}
