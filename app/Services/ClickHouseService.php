<?php

namespace App\Services;

use ClickHouseDB\Client;
use Random\RandomException;

class ClickHouseService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'host' => env('CLICKHOUSE_HOST'),
            'port' => env('CLICKHOUSE_PORT'),
            'username' => env('CLICKHOUSE_USERNAME'),
            'password' => env('CLICKHOUSE_PASSWORD'),
        ]);
    }

    /**
     * @throws RandomException
     */
    public function logPageView($userId, $page): void
    {
        $this->client->insert('page_views', [
            [random_int(1, 100000), $userId, $page, date('Y-m-d H:i:s')]
        ], ['id', 'user_id', 'page', 'created_at']);
    }

    public function getViews(): array
    {
        return $this->client->select('SELECT * FROM page_views')->rows();
    }
}
