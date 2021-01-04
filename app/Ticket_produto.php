<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Ticket_produto extends Pivot
{
   	/**
    * The table associated with the model.
    *
    * @var string
    */

	protected $table = 'ticket_produto';

	public $timestamps = false;
}
