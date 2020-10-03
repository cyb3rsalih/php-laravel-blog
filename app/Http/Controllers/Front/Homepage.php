<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;

use Validator;


class Homepage extends Controller
{

    public function __construct(){

        view()->share('pages', Page::orderBy('order',"ASC")->get());
        view()->share('categories', Category::inRandomOrder()->get());
    }

    public function index(){
        $data['articles'] = Article::orderBy('created_at','DESC')->paginate(2);
        return view('front.homepage',$data);
    }


    public function single($category_slug,$slug){
        $category = Category::where('slug',$category_slug)->first() ?? abort(403,"Böyle bir kategori yok.");
        $article = Article::where('slug',$slug)->where('category_id',$category->id)->first() ?? abort(403,"Böyle bir yazı yok.");
        $data['article'] = $article;

        $article->increment('hit');

        $data['categories'] = Category::inRandomOrder()->get();
        return view('front.single',$data);
    }

    public function category($slug){
        $category = Category::where('slug',$slug)->first() ?? abort(403,"Böyle bir kategori yok.");
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id',$category->id)->orderBy('created_at','DESC')->paginate(2);
        return view('front.category',$data);

    }

    public function page($slug){
        $page = Page::where('slug',$slug)->first() ?? abort(403,"Böyle bir sayfa bulunamadı!");
        $data['page']=$page;
        return view('front.page',$data);
    }
    
    public function contact(){
        return view('front.contact');
    }

    public function contactPost(Request $request){

        $rules = [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:10|max:1000'
        ];
        $validate = Validator::make($request->post(),$rules);

        if($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
            // withInput dersek Kullanıcı bilgileri kaybolmuyor .
            // with('errors',$blabla) === withErrors($blabla)
        }

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->topic = $request->topic;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->route('contact')->with('success',"Mesajınız iletildi! Teşekkür ederiz.");
        
    }
}
