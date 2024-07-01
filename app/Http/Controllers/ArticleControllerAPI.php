<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $article;
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
    public function index()
    {
        //
        $articles = $this->article->all();
        if(count($articles) == 0){
            return ApiResponse::error(404,"Articles not found!!!");
        }
        return ApiResponse::success(new ArticleCollection($articles),'Get all article successful');
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
