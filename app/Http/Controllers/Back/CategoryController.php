<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Article;
class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::all();
        return view('back.categories.index',compact('categories'));
    }

    public function switch(Request $request)
    {
        $category=Category::findOrFail($request->id);
        $category->status=$request->statu=="true" ? 1 : 0;
        $category->save();
    }
    public function create(Request $request)
    {
        $isExist=Category::whereSlug(Str::of($request->category)->slug('-'))->first();
        if($isExist){
            toastr()->error($request->category.' adında bir kategori bulunmaktadır.');
            return redirect()->back();
        }
        $category=new Category;
        $category->name=$request->category;
        $category->slug=Str::of($request->category)->slug('-');
        $category->save();
        toastr()->success('Kategori başarıyla oluşturuldu.');
        return redirect()->back();
    }

    public function getData(Request $request)
    {
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }
    public function update(Request $request)
    {
        $isSlug=Category::whereSlug(Str::of($request->slug)->slug('-'))->whereNotIn('id',[$request->id])->first();
        $isName=Category::whereName($request->category)->whereNotIn('id',[$request->id])->first();
        if($isSlug or $isName){
            toastr()->error($request->category.' adında bir kategori bulunmaktadır.');
            return redirect()->back();
        }
        $category=Category::findOrFail($request->id);
        $category->name=$request->category;
        $category->slug=Str::of($request->slug)->slug('-');
        $category->save();
        toastr()->success('Kategori başarıyla güncellendi.');
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        $category=Category::findOrFail($request->id);
        if($category->id==1){
            toastr()->error('Bu kategori silinemez.');
            return redirect()->back();
        }
        $message='';
        $count=$category->articleCount();
        if($count>0){
            Article::where('category',$category->id)->update(['category'=>1]);
            $defaultCategory=Category::find(1);
            $message='Bu kategoriye ait '.$count.' makale '.$defaultCategory->name.' kategorisine taşındı.';
        }
        $category->delete();
        toastr()->success('Kategori başarıyla silindi. '.$message);
        return redirect()->back();
    }

}
