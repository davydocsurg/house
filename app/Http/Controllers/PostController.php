<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Category;
use App\Post;
use Auth;
use DB;

class PostController extends Controller
{
    public function post(){
        $categories = Category::all();
        return view('posts/post', ['categories' => $categories]);
    }
 
    public function addPost(Request $request){
 
     $this->validate($request, [
         'post_title' => 'required',
         'post_body' => 'required',
         'post_image' => 'required',
         'category_id' => 'required'
      ]);
      $posts = new Post;
      $posts->user_id = Auth::user()->id;
      $posts->post_title = $request->post_title;
      $posts->post_body = $request->post_body;
      $posts->category_id = $request->category_id;
      if($request->hasFile('post_image')){
             $file = $request->file('post_image');
             $file->move(public_path(). '/houses/', $file->getClientOriginalName());
             $url = URL::to("/").'/houses/'. $file->
             getClientOriginalName();
 
      }
      $posts->post_image = $url;
      $posts->save();
      return redirect('/home')->with('response', 'Post Published Successfully');
 }

 public function view($post_id){
    $posts = Post::where('id','=',$post_id)->get();
    // $likePost = Post::find($post_id);
    // $likeCtr = Like::where(['post_id' => $likePost->id])->count();
    // $dislikeCtr = Dislike::where(['post_id' => $likePost->id])->count();

    // return $likeCtr;
    //  exit();
    $categories = category::all();
  

    return view('posts.view', ['posts' => $posts, 'categories' => $categories,]);
}

public function edit($post_id){
    $categories = Category::all();
    $posts = Post::find($post_id);
    $category = Category::find($posts->category_id);
    return view('posts.edit',['categories' => $categories, 'posts' => $posts, 'category' => $category,]);
}

public function editPost(Request $request, $post_id){
    $this->validate($request, [
        'post_title' => 'required',
        'post_body' => 'required',
        'post_image' => 'required',
        'category_id' => 'required'
     ]);
     $posts = new Post;
     $posts->post_title = $request->post_title;
     $posts->user_id = Auth::user()->id;
     $posts->post_body = $request->post_body;
     $posts->category_id = $request->category_id;
     if($request->hasfile('post_image')){
            $file =$request->file('post_image');
            $file->move(public_path(). '/houses/', $file->getClientOriginalName());
            $url = URL::to("/").'/houses/'. $file->
            getClientOriginalName();
     }
     $posts->post_image = $url;
     $data = array(
            'post_title' => $posts->post_title,
            'user_id' => $posts->user_id,
            'post_image' => $posts->post_image,
            'category_id' => $posts->category_id,
            'post_body' => $posts->post_body
     );
     Post::where('id', $post_id)
     ->update($data);
     $posts->update($data);
     return redirect('/home')->with('response', 'Post Updated Successfully');
}

public function deletePost(Request $request, $post_id){
    Post::where('id', $post_id)
    ->delete();
    return redirect('/home')->with('response', 'Post deleted Successfully`');
}

public function category($cat_id){
    $categories = Category::all();
    $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.*')
            ->where(['categories.id' => $cat_id])
            ->get();


 return view('categories/categoriesposts', ['categories' => $categories, 'posts' => $posts ]);
}


}
