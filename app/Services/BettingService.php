<?php

namespace App\Services;

use App\Models\Bet;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessBet;
use App\Events\BetPlaced;
use App\Jobs\LogBetToClickHouse;

class BettingService
{
    public function placeBet(User $user, array $data): Bet
    {
        return DB::transaction(function () use ($user, $data) {
            $bet = new Bet();
            $bet->user_id = $user->id;
            $bet->amount = $data['amount'];
            $bet->game_id = $data['game_id'];
            $bet->status = 'pending';
            $bet->save();

            // Кешируем ставку
            Cache::put(Bet::cacheKey($bet->id), $bet, now()->addMinutes(10));

            // Отправляем в очередь
            ProcessBet::dispatch($bet->id);
            LogBetToClickHouse::dispatch($bet);

            // Генерируем событие
            event(new BetPlaced($bet));

            return $bet;
        });
    }
}
