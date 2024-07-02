<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Article $article;
    public function __construct(Article $article){
        $this->article = $article;
    }
    public function index()
    {
        //
        $articles = $this->article->all();
        return view("articles.index",[
            "articles" => $articles,
            "trash"=> false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        // $article = Article::find($id);
        return view('articles.detail',['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = $this->article->where('id', $id)
            ->update([
                'title' => $request->input('title'),
                'idCat'=> $request->input('idCat'),
                'description' => $request->input('description'),
                'idAu' => $request->input('idAu'),
                'date' => $request->input('date'),
            ]);
        return to_route("articles.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();
        return redirect('/articles');
    }

    public function showTrash(){
        $articles = $this->article->onlyTrashed()->get();
        return view("articles.index",[
            "articles" => $articles,
            "trash"=>true,
        ]);
    }
    public function restore(Request $request){
        $this->article->withTrashed()->find($request->article_id)->restore();
        return to_route("articles.index");
    }
    public function forceDelete(Request $request){
        $this->article->onlyTrashed()->find($request->article_id)->forceDelete();
        if($this->article->onlyTrashed()->count() == 0){
            return to_route("articles.index");
        }
        return to_route("articles.trash");
    }
}
