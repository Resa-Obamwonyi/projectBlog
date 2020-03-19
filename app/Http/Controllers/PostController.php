<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function post(){
    	$categories = Category::all();
        return view('posts.post', ['categories' => $categories]);
    }

    public function addPost(Request $request){

    	//return $request->input('post_title');
    	$this->validate($request, [
            'post_title'=> 'required',
            'post_body'=> 'required',
            'category_id'=> 'required',
            'post_image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);
       
    if ($request->hasFile('post_image')) {
        $extension = $request->file('post_image')->getClientOriginalExtension();
        $file = md5(uniqid()) . '.' .$extension;
        $path = $request->file('post_image')->storeAs('public/postimages', $file);
     }


        $post = Post::forceCreate([
            "post_title" => request('post_title'),
            "user_id" => auth()->user()->id,
            "post_body" => request('post_body'),
            "category_id" => request('category_id'),
            "post_image" => $file,
            
        ]);
  
   
    return redirect()->to('/home')->withSuccess('A New Post Published Successfully.');

    	 
    }

  public function view($post_id){
  	  $posts = Post::where('id','=', $post_id)->get();
  	  $categories = Category::all();
  	  return view('posts.view', ['posts'=> $posts, 'categories' => $categories]);
  }

  public function edit($post_id){
    $categories = Category::all();
    $posts = Post::find($post_id);
    $category = Category::find($posts->category_id);
  	 return view('posts.edit', ['categories'=> $categories, 'posts' => $posts, 'category' => $category]);
  }
}
