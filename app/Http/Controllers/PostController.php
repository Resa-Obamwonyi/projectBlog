<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Profile;
use App\Like;
use App\Dislike;
use App\Comment;
use DB;
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
      $likePost = Post::find($post_id);
      $likeCount = Like::where(['post_id' => $likePost->id])->count();
      $dislikeCount = Dislike::where(['post_id' => $likePost->id])->count();

  	  $categories = Category::all();
      $comments = DB::table('users')
    ->join('comments','users.id','=','comments.user_id')
    ->join('posts','comments.post_id', '=', 'posts.id')
    ->select('users.name','comments.*')
    ->where(['posts.id'=> $post_id])
    ->get();
  

  	  return view('posts.view', ['posts'=> $posts, 'categories' => $categories, 'likeCount' => $likeCount,  'dislikeCount' => $dislikeCount, 'comments' => $comments]);
  }

  public function edit($post_id){
    $categories = Category::all();
    $posts = Post::find($post_id);
    $category = Category::find($posts->category_id);
  	 return view('posts.edit', ['categories'=> $categories, 'posts' => $posts, 'category' => $category]);
  }

  public function editPost( Request $request, $post_id){
      $this->validate($request, [
            'post_title'=> 'required',
            'post_body'=> 'required',
            'category_id'=> 'required',
            'post_image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);

      $posts = new Post;
      $posts ->post_title =$request->input('post_title');
      $posts ->user_id =Auth::user()->id;
      $posts ->post_body =$request->input('post_body');
      $posts ->category_id =$request->input('category_id');
       
    if ($request->hasFile('post_image')) {
        $extension = $request->file('post_image')->getClientOriginalExtension();
        $file = md5(uniqid()) . '.' .$extension;
        $path = $request->file('post_image')->storeAs('public/postimages', $file);
     }

     $posts->post_image = $file;
     $data = array(
             'post_title'=>$posts->post_title,
             'user_id'=>$posts->user_id,
             'post_body'=>$posts->post_body,
             'category_id'=>$posts->category_id,
             'post_image'=>$posts->post_image
     );
     Post::where('id', $post_id)
     ->update($data);
     $posts->update();

    return redirect()->to('/home')->withSuccess('Post Updated Successfully.');

  }

  public function deletePost($post_id) {
      Post::where('id', $post_id)
      ->delete();
      return redirect()->to('/home')->withSuccess('Post Deleted Successfully.');
  }

  public function category($category_id){
    $categories = Category::all();
    $posts = DB::table('posts')
    ->join('categories','posts.category_id','=','categories.id')
    ->select('posts.*','categories.*')
    ->where(['categories.id'=> $category_id])
    ->get();

  return view('categories.postcategory',['categories' =>$categories, 'posts' => $posts]);

  }
  public function like($id){
    $loggedin_user = Auth::user()->id;
    $like_user = Like::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
    if(empty($like_user->user_id))
    {
        $user_id = Auth::user()->id;
        $email = Auth::user()->email;
        $post_id = $id;
        $like = new Like;
        $like->user_id = $user_id;
        $like->email = $email;
        $like->post_id = $post_id;
        $like->save();

        return redirect("/view={$id}");

    }
    else {
      return redirect("/view={$id}");
    }
  }

  public function dislike($id){
    $loggedin_user = Auth::user()->id;
    $dislike_user = Dislike::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
    if(empty($dislike_user->user_id))
    {
        $user_id = Auth::user()->id;
        $email = Auth::user()->email;
        $post_id = $id;
        $dislike = new Dislike;
        $dislike->user_id = $user_id;
        $dislike->email = $email;
        $dislike->post_id = $post_id;
        $dislike->save();

        return redirect("/view={$id}");

    }
    else {
      return redirect("/view={$id}");
    }
  }

  public function comment(Request $request, $post_id){
          $this->validate($request, [
            'comment'=> 'required',
     ]);
          $comment = new Comment;
          $comment->user_id = Auth::user()->id;
          $comment->post_id = $post_id;
          $comment->comment = $request->input('comment');
          $comment->save();
       return redirect()->to("/view={$post_id}")->withSuccess('Comment Added Successfully.');
  }

  public function search(Request $request){
     $user_id = Auth::user()->id;
     $profile = Profile::find($user_id);
     $keyword = $request->input('search');
     $post = Post::where('post_title', 'LIKE', '%'.$keyword.'%')->get();
   return view('posts.searchposts', ['profile' => $profile, 'post' => $post]);
  }
}
