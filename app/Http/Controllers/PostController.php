<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'website_id' => 'required|integer',
        ]);

        // Create the new post using the validated data
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        $post->website_id = $validatedData['website_id'];
        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
        ]);
    }


}
