<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioLikeController extends Controller
{
    public function toggle(Request $request, Portfolio $portfolio)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Je moet ingelogd zijn om te liken'
            ], 401);
        }

        $userId = Auth::id();

        $existingLike = PortfolioLike::where('portfolio_project_id', $portfolio->id)
                                     ->where('user_id', $userId)
                                     ->first();

        if ($existingLike) {
            $existingLike->delete();
            $portfolio->decrement('likes_count');

            return response()->json([
                'success' => true,
                'liked' => false,
                'likes' => $portfolio->fresh()->likes_count,
                'message' => 'Like verwijderd'
            ]);
        } else {
            PortfolioLike::create([
                'portfolio_project_id' => $portfolio->id,
                'user_id' => $userId,
            ]);

            $portfolio->increment('likes_count');

            return response()->json([
                'success' => true,
                'liked' => true,
                'likes' => $portfolio->fresh()->likes_count,
                'message' => 'Bedankt voor je like!'
            ]);
        }
    }
}
