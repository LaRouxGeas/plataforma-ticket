<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Ticket_regiao extends Pivot
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

	protected $table = 'ticket_regiao';

	public $timestamps = false;
}
