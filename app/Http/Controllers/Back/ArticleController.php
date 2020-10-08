<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::orderBy('created_at','ASC')->get();
        return view('back.articles.index',compact('articles')); // $ lı hali yukarda varsa böyle gönderip çağırabiliriz.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name',"ASC")->get(); // direk Category::all() olarak alabiliriz.
        return view("back.articles.create",compact('categories')); //compact(categories,baskaseyler,asd,adsf) seklinde olur
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,jpg,png|max:100'
        ]);

       $article = new Article;
       $article->title = $request->title;
       $article->category_id = $request->category;
       $article->content = $request->content;
       $article->slug = str_slug($request->title);

       if($request->hasFile('image')){
           $imageName = str_slug($request->title).".".$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads'),$imageName);
        $article->image='../uploads/'.$imageName;
    }
    $article->save();
    toastr()->success('Başarılı','Makale başarıyla oluşturuldu!');
    return redirect()->route('admin.makaleler.index');

       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Just ".$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::where('id',$id)->first() ?? abort(403,"Böyle bir makale yok!");
        //$article=Article::find($id); -> yoksa null döner, if ile kontrol etmek gerekir
        //$article=Article::findOrFail($id); -> 404 döndür. en üsttekinin aynısı
         
        $categories = Category::orderBy('name',"ASC")->get(); // direk Category::all() olarak alabiliriz.
        return view("back.articles.update",compact('categories','article')); //compact(categories,baskaseyler,asd,adsf) seklinde olur     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,jpg,png|max:1024 '
        ]);

       $article = Article::findOrFail($id);
       $article->title = $request->title;
       $article->category_id = $request->category;
       $article->content = $request->content;
       $article->slug = str_slug($request->title);

       if($request->hasFile('image')){
           $imageName = str_slug($request->title).".".$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads'),$imageName);
        $article->image='../uploads/'.$imageName;
    }
    $article->save();
    toastr()->success('Başarılı','Makale başarıyla güncellendi!');
    return redirect()->route('admin.makaleler.index');

    }

    public function switch(Request $request){
        $article=Article::findOrFail($request->id);
        
        if($request->statu == 'true'){
            $article->status = 1;
        }
        else{
            $article->status = 0;
        } 
            
        $article->save();
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
