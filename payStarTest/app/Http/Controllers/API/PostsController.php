<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Post;
use App\Http\Resources\Post as PostResource;

class PostsController extends BaseController
{

    public function index()
    {
        $posts = Post::all();
        return $this->sendResponse(PostResource::collection($posts), 'Posts fetched.');
    }


    public function store(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $post = Post::create($input);
        return $this->sendResponse(new PostResource($post), 'Post created.');
    }


    public function show($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new PostResource($post), 'Post fetched.');
    }


    public function update(Request $request, Post $post)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $post->title = $input['title'];
        $post->description = $input['description'];
        $post->save();

        return $this->sendResponse(new PostResource($post), 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return $this->sendResponse([], 'Post deleted.');
    }
}
