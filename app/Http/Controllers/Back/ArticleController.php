<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles=Article::orderBy('created_at','ASC')->get();
        return view('back.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $article = new Article;
        $article->title = $request->title;
        $article->category = $request ->category;
        $article->content = $request->content;
        $article->slug= Str::of($request->title)->slug('-');
        if($request->hasFile('image')){
            $imageName = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image='uploads/'.$imageName;
        }
        $article->save();
        #toastr()->success('Makale başarıyla oluşturuldu.'); //toastr mesajı
        return redirect()->route('admin.makaleler.index')->with('success','Makale başarıyla oluşturuldu.');
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
    public function edit(string $id)
    {
        $article=Article::findOrFail($id);
        $categories=Category::all();
        return view('back.articles.update',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->category = $request ->category;
        $article->content = $request->content;
        $article->slug= Str::of($request->title)->slug('-');
        if($request->hasFile('image')){
            $imageName = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image='uploads/'.$imageName;
        }
        $article->save();
        #toastr()->success('Makale başarıyla oluşturuldu.'); //toastr mesajı
        return redirect()->route('admin.makaleler.index')->with('success','Makale başarıyla Güncellendi.');
    }

    public function switch(Request $request)
    {
        $article = Article::findOrFail($request->id);
        $article->status = $request->statu == 'true' ? 1 : 0;
        $article->save();
    }
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
