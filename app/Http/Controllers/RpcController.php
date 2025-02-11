<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RpcController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->json()->all();
        if ($data['method'] === 'sum') {
            return response()->json([
                'jsonrpc' => '2.0',
                'result' => $data['params'][0] + $data['params'][1],
                'id' => $data['id']
            ]);
        }
        return response()->json(['error' => 'Method not found'], 404);
    }
}
