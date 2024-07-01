<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentCollection;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Responses\ApiResponse;
use App\Models\Post;
use Illuminate\Http\Request;

class PostControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Post $post;
    public function __construct(Post $post){
        $this->post = $post;
    }

    public function searchCommentContainCharacterWithPostId(Request $request){
        //get post_id and search from request
        $postSearch = $this->post->find($request["post_id"]);
        $search = $request["search"];

        $commentsSearch = $postSearch->titleContainSearchWithPostId($search);
        // return $commentsSearch;
        if(count($commentsSearch)==0){
            return ApiResponse::error("Comment contain character $search not found",404);
        }
        //format data
        $postSearch->comments = $commentsSearch;
        return ApiResponse::success(new PostCollection([$postSearch]),"Find comment successful");

    }
    public function searchCommentContainSearchPost(Request $request){
        $posts = $this->post->all();
        foreach( $posts as $post1){
            $cmtSearch = $post1->titleContainSearchWithPostId( $request["search"] );
            $post1 -> comment = $cmtSearch;
        }
        // remove post without comment
        $filteredPosts = $posts->filter(function ($post){
            return $post-> comments->count() != 0;
        });
        return ApiResponse::success(new PostCollection($filteredPosts),"Find all post have comment contain search");
    }
    public function index()
    {
        //
        $posts = $this->post->all();
        if(count($posts) == 0){
            return ApiResponse::error(404,"Post not found!!!");
        }

        return ApiResponse::success(new PostCollection($posts),"Get all post successful");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $post = $this->post->find($id);
        if(!$post){
            return ApiResponse::error(404,"Post not found!!!");
        }
        return ApiResponse::success(new PostResource($post),"Find post by id successful");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
