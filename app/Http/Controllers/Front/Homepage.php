<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;


class Homepage extends Controller
{
    public function index()
    {
        $categories = Category::inRandomOrder()->get();
        $articles = Article::orderBy('created_at','desc')->paginate(1)->withPath(url('sayfa'));
        $pages = Page::orderBy('order','ASC')->get();   
        return view('front.homepage',compact('categories','articles','pages'));
    }
    public function single($category,$slug){
        $category=Category::whereSlug($category)->first() ?? abort(403,'Böyle bir kategori bulunamadı');
        $article = Article::where('slug', $slug)->where('category', $category->id)->first() ?? abort(403, 'Böyle bir yazı bulunamadı');
        $categories = Category::inRandomOrder()->get();
        $article->increment('hit');
        return view('front.single',compact('article','categories'));
    }
    public function category($slug){
        $category=Category::whereSlug($slug)->first() ?? abort(403,'Böyle bir kategori bulunamadı');
        $articles=Article::where('category',$category->id)->orderBy('created_at','DESC')->paginate(1);
        $categories = Category::inRandomOrder()->get();
        return view('front.category',compact('articles','category','categories'));
    }

    public function page($slug){
        $page = Page::whereSlug($slug)->first() ?? abort(403,'Böyle bir sayfa bulunamadı');
        #$categories = Category::inRandomOrder()->get();
        $pages = Page::orderBy('order','ASC')->get(); 
        return view('front.page',compact('page','pages'));
    }

}
