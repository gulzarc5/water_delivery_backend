<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCoin\UserCoinResource;
use App\Models\UserCoin;
use App\Models\UserCoinHistory;
use Illuminate\Http\Request;

class UserCoinController extends Controller
{
    public function index(Request $request)
    {
        $coin = UserCoin::where('user_id',$request->user()->id)->first();
        $response = [
            'status' => true,
            'message' => 'User Coiuns',
            'data' =>  $coin,
        ];
        return response()->json($response, 200);
    }

    public function history(Request $request)
    {
        $coin = UserCoin::where('user_id',$request->user()->id)->first();
        $coin_history = null;
        if ($coin) {
            $coin_history = UserCoinHistory::where('user_coin_id',$coin->id)->latest()->paginate(10);
        }
        $response = [
            'status' => true,
            'message' => 'USer Coin History',
            'current_page' => $coin_history->currentPage(),
            'total_pages' => $coin_history->lastPage(),
            'has_more_pages' => $coin_history->hasMorePages(),
            'total_data' => $coin_history->total(),
            'coin' => $coin,
            'data' => UserCoinResource::collection($coin_history),
        ];
        return response()->json($response, 200);
    }
}
