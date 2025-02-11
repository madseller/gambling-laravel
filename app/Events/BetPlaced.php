<?php

namespace App\Events;

use App\Models\Bet;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BetPlaced
{
    use Dispatchable, SerializesModels;

    public function __construct(public Bet $bet) {}
}
