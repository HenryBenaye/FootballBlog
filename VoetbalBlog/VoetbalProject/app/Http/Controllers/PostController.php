<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();
        $likes = Like::where('user_id', Auth::user()->id)->get();
        return view('dashboard', ['posts' => $posts, 'likes' => $likes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->content = $request['input_field'];
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);
        return redirect()->route('dashboard');
    }

    public function savePost(Request $request)
    {
        DB::table('saved_posts')->insert([
            'user_id' => Auth::user()->id,
            'post_id' => $request['post_id']
        ]);
        return redirect()->route('dashboard');
    }

    public function likePost(Request $request)
    {

        $like = new Like();
        $like->post_id = $request['postId'];
        $like->user_id = Auth::user()->id;
        $like->save();
        return $like->id;
    }

    public function deleteLike(Request $request)
    {
        Like::where('post_id',$request['postId'])
            ->where('user_id',Auth::user()->id )->delete();

    }
}
