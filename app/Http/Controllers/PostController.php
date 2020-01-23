<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Category;
use App\Post;
use\App\Comment;
use \App\Like;
use \App\Dislike;
use Auth;

class PostController extends Controller
{
    public function post (){
        $categories =Category::all();
        return view ('posts.post', ['categories' => $categories]);
    }
    public function addPost (Request $request){
        $this->validate($request,[
            'post_title'=>'required',
            'post_body'=>'required',
            'category_id'=>'required',
            'post_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:42344',
            
        ]); 
        
        if($request->hasfile('post_image')){
            $file=$request->file('post_image')->getClientOriginalName();
            $fileWithoutExt=pathinfo($file, PATHINFO_FILENAME);
            // dd($fileWithoutExt);
            $extension=$request->file('post_image')->getClientOriginalName();
            $fileTostore=$fileWithoutExt.'_'.time().'.'.$extension;
            $request->file('post_image')->storeAs('public/posts/images/',$fileTostore);
            
            $posts =new Post;
            $posts->post_title =$request->input('post_title');
            $posts->user_id =Auth::user()->id;
            $posts->post_body =$request->input('post_body');
            $posts->category_id =$request->input('category_id');
            $posts->post_image =$request->input('post_image');
            $posts->post_image = $fileTostore;
            $posts->save();

            return redirect ('/home')->with('response', 'Post Added Succesfully');
        }

    }
    public function view ($post_id){
       $post = Post::where('id', '=', $post_id)->get();
       $likepost = Post::find($post_id);
       $likeCtr = Like::where(['post_id' =>$likepost->id])->count();
       $dislikeCtr = Dislike::where(['post_id' =>$likepost->id])->count();
       $categories =Category::all();
       return view ('posts.view', ['post' => $post, 'categories' => $categories, 'likeCtr' => $likeCtr, 'dislikeCtr' => $dislikeCtr]);
    }
    public function edit ($post_id){
        $post = Post::findorfail($post_id);
        $categories =Category::all();
        $categories =Category::find($post->category_id);
        return view ('posts.edit', ['post' => $post, 'categories' => $categories]);
        
    }
        public function editpost ($id, Request $request)
    {
        $post = Post::findOrFail($id);

        $this->validate($request, [
            'post_title'=>'required',
            'post_body'=>'required',
            // 'category_id'=>'required',
            'post_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:42344',
        ]);
        

        if($request->hasfile('post_image')){
            $file=$request->file('post_image')->getClientOriginalName();
            $fileWithoutExt=pathinfo($file, PATHINFO_FILENAME);
            // dd($fileWithoutExt);
            $extension=$request->file('post_image')->getClientOriginalName();
            $fileTostore=$fileWithoutExt.'_'.time().'.'.$extension;
            $request->file('post_image')->storeAs('public/posts/images/',$fileTostore);
            $posts =new Post;
            $posts->post_image = $fileTostore;
            $posts->save();

         $input = $request->all();
         $posts->post_image = $fileTostore;
         $post->fill($input)->save();

        return redirect ('/home')->with('response', 'Post Added Succesfully');
        }
    }
    public function delete ($id){

        $post = Post::findOrFail($id);

        $post->delete();
    
       
    
        return redirect ('/home')->with('response', 'Task successfully deleted!');
        
    }

    public function comment(Request $request)
{
    $this->validate($request,[
        'post'=>'required',
        
        
    ]); 

    $posts =new Post;
    $posts->user_id =Auth::user()->id;
    $posts->post_body =$request->input('post_body');
    $posts->save();
    return redirect("/comment")->with('response', 'Comments Added Succesfully');
}

    public function show($id)
    {
        $post = post::where($id)->firstOrFail();
        $comments = $post->comments()->get();
        return view('Posts.show', compact('posts', 'comments'));
    }

    public function replyStore(Request $request)
    {
        $posts =new Post;
        $posts->user_id =Auth::user()->id;
        $posts->post_body =$request->input('post_body');
        $posts->save();

        return back();

    }
    
    public function like($id){
      $loggedin_user = Auth::user()->id;
      $like_user = Like::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
      if(empty($like_user->user_id)){
        $user_id = Auth::user()->id;
        $email = Auth::user()->email;
        $post_id = $id;
        $like = new Like;
        $like->user_id = $user_id;
        $like->email = $email;
        $like->post_id = $post_id;
        $like->save();
        return redirect("/view/{$id}");
      }
      else{
        return redirect("/view/{$id}");
      }
    }
    public function dislike($id){
        $loggedin_user = Auth::user()->id;
        $like_user = Dislike::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        if(empty($like_user->user_id)){
          $user_id = Auth::user()->id;
          $email = Auth::user()->email;
          $post_id = $id;
          $like = new Dislike;
          $like->user_id = $user_id;
          $like->email = $email;
          $like->post_id = $post_id;
          $like->save();
          return redirect("/view/{$id}");
        }
        else{
          return redirect("/view/{$id}");
        }
      }

    //
}
