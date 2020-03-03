<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
