<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Author $author)
    {
        //
        $authors = $author->likeName();
        // dd($authors);
        return view("authors.index",[
            "authors" => $authors
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
     * @Author MaiDat
     * Date
     * Param string id : id Author
     * Param Request: reqest
     */

    public function show(string $id)
    {
        //
        $author = Author::find($id);
        return view("authors.show",[
            'author' => $author,
            'articles' => $author->article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
