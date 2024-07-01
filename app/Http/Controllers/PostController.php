<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);

        foreach ($posts as $post) {
            $dummyPost = Http::get('https://dummyjson.com/posts/' . $post->dummy_post_id)->json();
            $post->title = $dummyPost['title'];
            $post->body = substr($dummyPost['body'], 0, 128);
        }

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'dummy_post_id' => 'required|integer',
        ]);

        $post = new Post();
        $post->user_id = auth()->id();
        $post->dummy_post_id = $request->dummy_post_id;
        $post->save();

        return response()->json($post, 201);
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['error' => 'You can only edit your own posts'], 403);
        }

        $request->validate([
            'dummy_post_id' => 'required|integer',
        ]);

        $post->dummy_post_id = $request->dummy_post_id;
        $post->save();

        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['error' => 'You can only delete your own posts'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
