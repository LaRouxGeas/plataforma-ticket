<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Ticket_empresa extends Pivot
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

	protected $table = 'ticket_empresa';

	public $timestamps = false;
}
