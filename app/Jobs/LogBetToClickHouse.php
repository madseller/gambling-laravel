<?php

namespace App\Jobs;

use App\Models\Bet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LogBetToClickHouse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bet;

    public function __construct($bet)
    {
        $this->bet = $bet;
    }

    public function handle()
    {
        BetLog::insert([
            'bet_id'     => $this->bet->id,
            'user_id'    => $this->bet->user_id,
            'game_id'    => $this->bet->game_id,
            'amount'     => $this->bet->amount,
            'status'     => $this->bet->status,
            'created_at' => now(),
        ]);
    }
}
