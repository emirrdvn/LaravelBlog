<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;


class Homepage extends Controller
{
    public function index()
    {
        $categories = Category::inRandomOrder()->get();
        $articles = Article::orderBy('created_at','desc')->get();
        
        return view('front.homepage',compact('categories','articles'));
    }
    public function single($category,$slug){
        $category=Category::whereSlug($category)->first() ?? abort(403,'Böyle bir kategori bulunamadı');
        $article = Article::where('slug', $slug)->where('category', $category->id)->first() ?? abort(403, 'Böyle bir yazı bulunamadı');
        $categories = Category::inRandomOrder()->get();
        $article->increment('hit');
        return view('front.single',compact('article','categories'));
    }
}
