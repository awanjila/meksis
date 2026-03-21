<?php

namespace App\Http\Controllers;
use App\Models\blog;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){

        $request->all();
        $comment =new Comment;
        $comment->insert([
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            'blog_id' => $request->blog_id

        ]);

        return request()->json($comment);
    }


    public function getComments($blog): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            Blog::query()
                ->where('id',$blog)->with(['comments'])->first()
//            $blog->comments()->with('user')->latest()->get()
        );

    }
}
