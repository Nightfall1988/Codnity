<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function list() {
        $articles = $this->getAllArticles();
        return view('list', compact('articles'));
    }

    public function deleteArticle($id) {
        $article = Article::find($id);
        if ($article) {
            $article->status = 0;
            $article->save();
            return 1;
        } else {
            return 0;
        }

    }
    public function getAllArticles()
    {
        return  Article::where('status', '=', 1)->paginate(10); // Paginate articles, assuming 10 per page
    }

    public function getPaginatedArticles()
    {
        $articles = $this->getAllArticles();
        return response()->json($articles);
    }
}
