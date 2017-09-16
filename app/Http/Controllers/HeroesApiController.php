<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeroesApiController extends Controller
{
    public function abilities(Request $request, string $sessionId)
	{
		$result = DB::table('users')->select('id')->where('game_token', $sessionId)->first();
		if ($result)
		{
			$userId = $result->id;
			DB::update('UPDATE game_stats SET statsValue = \'\' WHERE statsKey = \'c_items\' AND user_id = :id', ['id' => $userId]);
			
			DB::update('UPDATE game_stats SET statsValue = \'15\' WHERE statsKey = \'c_wallet_hero\' AND user_id = :id', ['id' => $userId]);
			
			return '{
				result: "success",
				message: "successfully reset the user abilities"
			}';
		}
		else
		{
			return '{
				result: "error",
				message: "Couldn\'t match the sessionId with an existing user"
			}';
		}
	}
}
