<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Idea $idea)
    {
        Like::firstOrCreate([
            'user_id' => $request->user()->id,
            'idea_id' => $idea->id,
        ]);

        return back();
    }

    public function destroy(Request $request, Idea $idea)
    {
        Like::where('user_id', $request->user()->id)
            ->where('idea_id', $idea->id)
            ->delete();

        return back();
    }
}
