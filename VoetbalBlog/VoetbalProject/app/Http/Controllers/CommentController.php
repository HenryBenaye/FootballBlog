<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;



class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $comment = new Comment();
        $comment->comment = $request['comment'];
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post_id;
        $comment->save();
        return redirect()->route('dashboard');
    }
}
