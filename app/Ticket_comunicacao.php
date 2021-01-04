<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Ticket_comunicacao extends Pivot
{
    /**
    * The table associated with the model.
    *
    * @var string
    */

	protected $table = 'ticket_comunicacao';

	public $timestamps = false;
}
