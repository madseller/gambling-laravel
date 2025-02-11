<?php

namespace App\Http\Controllers;

use App\Services\BettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BetController extends Controller
{
    public function __construct(private readonly BettingService $bettingService) {}

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:1',
            'game_id' => 'required|integer',
        ]);

        $bet = $this->bettingService->placeBet(Auth::user(), $data);

        return response()->json(['bet' => $bet], 201);
    }
}
