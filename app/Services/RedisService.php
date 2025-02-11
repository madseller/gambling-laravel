<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class RedisService
{
    public function cacheUser($userId, $data)
    {
        Redis::set("user:{$userId}", json_encode($data));
    }

    public function getUser($userId)
    {
        $user = Redis::get("user:{$userId}");
        return $user ? json_decode($user, true) : null;
    }
}
