<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Bet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'game_id', 'status'];

    public static function cacheKey(int $betId): string
    {
        return "bet:{$betId}";
    }

    public static function findCached(int $betId): ?self
    {
        return Cache::remember(self::cacheKey($betId), now()->addMinutes(10), function () use ($betId) {
            return self::find($betId);
        });
    }
}
