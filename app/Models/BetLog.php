<?php

use Tinderbox\Clickhouse\Eloquent\Model;

class BetLog extends Model
{
    protected $table = 'bet_logs';
    protected $fillable = ['bet_id', 'user_id', 'game_id', 'amount', 'status', 'created_at'];
}
