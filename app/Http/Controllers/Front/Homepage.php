<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;
use Validator;
use Mail;


class Homepage extends Controller
{
    public function __construct(){
        if(Config::find(1)->active==0){
            return redirect()->to('site-bakimda')->send();
        }
        view()->share('pages',Page::where('status',1)->orderBy('order','ASC')->get());
        view()->share('categories',Category::where('status',1)->inRandomOrder()->get());
    }

    public function index()
    {
        $articles = Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
            $query->where('status',1); 
        })->orderBy('created_at','desc')->paginate(1)->withPath(url('sayfa'));
          
        return view('front.homepage',compact('articles'));
    }
    public function single($category,$slug){
        $category=Category::whereSlug($category)->first() ?? abort(403,'Böyle bir kategori bulunamadı');
        $article = Article::where('slug', $slug)->where('category', $category->id)->first() ?? abort(403, 'Böyle bir yazı bulunamadı');
        $article->increment('hit');

        return view('front.single',compact('article'));
    }
    public function category($slug){
        $category=Category::whereSlug($slug)->first() ?? abort(403,'Böyle bir kategori bulunamadı');
        $articles=Article::where('category',$category->id)->where('status',1)->orderBy('created_at','DESC')->paginate(1);

        return view('front.category',compact('articles','category'));
    }

    public function page($slug){
        $page = Page::whereSlug($slug)->first() ?? abort(403,'Böyle bir sayfa bulunamadı');
        #$categories = Category::inRandomOrder()->get();
        
        return view('front.page',compact('page'));
    }

    public function contact(){
        return view('front.contact');
    }
    public function contactpost(Request $request){
        $rules=[
            'name'=>'required|min:5',
            'email'=>'required|email',
            'topic'=>'required',
            'message'=>'required|min:10'
        ];
        $validate =Validator::make($request->post(),$rules);

        if($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }
        // LARAVEL 11'de daha farklı bu tam olmadı
        Mail::raw('Mesajı Gönderen:'.$request->name.'<br/>
                Mesajı gönderen mail :'.$request->email.'<br/>
                Mesajı Konusu :'.$request->topic.'<br/>
                Mesaj:'.$request->message.'<br/>  
                Mesajı gönderilme tarihi :'.now().'<br/>',function($message) use($request){
            $message->from('iletisim@blogsitesi.com','Blog Sitesi'); 
            $message->to('iletisim@blogsitesi.com');
            $message->subject($request->name.'mesaj gönderdi');
        });

        //Yönetim Panelinde Göstermek için
        /*$contact= new Contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->topic=$request->topic;
        $contact->message=$request->message;
        $contact->save();*/
        

        return redirect()->route('contact')->with('success','Mesajınız bize ulaştı');
    }
}
