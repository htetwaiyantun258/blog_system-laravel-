<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->except('index','detail');
    }

   public function index(){
    
        $data = Article::latest()->paginate(5);
       
        return view("articles.index",[
            'articles'=>$data,
           
        ]);
   }

   public function detail($id){
    $data = Article::find($id);
    // dd($data);
    return view('articles.detail',[
        'article'=> $data
    ]);
   }

   public function add(){
    $categories = Category::all();

    return view('articles.add',['categories'=> $categories]);
   }

   public function create(Request $request){
    $validator = validator(request()->all(),[
        "title" => "required",
        "body" => "required",
        "category_id" => "required",
    ]);

    if($validator->fails()){
        return back()->withErrors($validator);
    }

     $article = new Article;
     $article->title = request()->title;
     $article->body = request()->body;
     $article->category_id = request()->category_id;
     $article->user_id = auth()->id();
     $article->save();

     return redirect("/articles")->with("create_post", "Post Create Success");
   }

   public function edit($id){
    $article = Article::findOrFail($id);
    $categories = Category::all();
    
    
    return view("articles.edit",[
        "categories" => $categories,
        "article" => $article
    ]);
  }

  public function update(Request $request,$id){
    // $validator = validator(request()->all(),[
    //     "title" => "required",
    //     "body" => "required",
    //     "category_id" => "required",
    // ]);

    // if($validator->fails()){
    //     return back()->withErrors($validator);
    // }
    
     $article = Article::find($id);
     $article->title = request()->title;
     $article->body = request()->body;
     $article->category_id = request()->category_id;
     $article->save();

     return redirect("/articles")->with("update_post", "Post Update Success");
   }

   public function delete($id){
    $article = Article::find($id);

    if(Gate::allows("delete-article",$article)){
        $article->delete();
        return redirect("/articles")->with("info", "Article deleted");
    }
    return back()->with("unauthorize_delete_article", "Unauthorize Delete Article");
   }
}
