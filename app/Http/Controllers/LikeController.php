<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Article;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, Article $article)
    {
        $like = Like::where('user_id', auth()->id())
            ->where('article_id', $article->id)
            ->first();

        if ($like) {
            $like->delete();
            return response()->json(['status' => 'unliked', 'likes_count' => $article->likes()->count()]);
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'article_id' => $article->id,
            ]);
            return response()->json(['status' => 'liked', 'likes_count' => $article->likes()->count()]);
        }
    }
}
