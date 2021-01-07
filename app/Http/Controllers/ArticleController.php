<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('articles.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'required|image',
            'category_id' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $filename = time().'_'.$request->file('cover_image')->getClientOriginalName();
        $request->file('cover_image')->storeAS('upload', $filename);

        $article = new Article;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->cover_image = $filename;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect('/articles')->with('add', 'An Article is Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $galleries = Gallery::all();
        return view('articles.detail', compact('article', 'galleries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories =  Category::all();

        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'required|image',
            'category_id' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $filename = time().'_'.$request->file('cover_image')->getClientOriginalName();
        $request->file('cover_image')->storeAS('upload', $filename);

        $article = Article::find($id);
        Storage::delete('upload/' .$article->cover_image);
        $article->title = $request->title;
        $article->body = $request->body;
        $article->cover_image = $filename;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect('/articles')->with('update', 'An Article is Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        Storage::delete('upload/' .$article->cover_image);
        $galleries =  DB::select('select name from galleries where article_id = ?', ["$id"]);
        

        $names = json_decode(json_encode($galleries), true);


        foreach($names as $innerArray){
            foreach ($innerArray as $name) {
                Storage::delete('photo/' .$name);
            }
        }
        
        DB::delete('delete from galleries where article_id = ?', ["$id"]);

        $article->delete();

        return redirect('/articles')->with('info', 'Article deleted');
    }
}
