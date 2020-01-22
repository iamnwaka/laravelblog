<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Comment;

class CategoryController extends Controller
{
    public function categories (){
        return view ('category.categories');
    }

    public function addCategory (Request $request){
        // return $request ->input('category');
        $this->validate($request,[
            'category'=>'required'
        ]);
        $category = new Category;
        $category->category =$request->input('category');
        $category->save();
        return redirect('/categories')->with('response', 'CATEGORY ADDED SUCCESSFULLY');
    }

    public function category($id){

        $comments = Comment::where($id)->firstOrFail();
        return view('Posts.cat', compact('comments'));
    }
}
