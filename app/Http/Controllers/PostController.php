<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{
    public function createPost(){
        return view('post.create');
    }

    public function addPost(Request $request){
        $data = $request->all();
        $post = new Post();
        $post->post_name = $data['post_name'];
        $post->post_content = $data['post_content'];

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('post'), $imageName);
        $post->image = $imageName;

        $post->save();
        return redirect()->back();
    }

    public function allPost(){
        $posts = Post::all();
        return view ('post.index', compact('posts'));
    }

    public function editPost($id){
        $post = Post::findOrFail($id);
        return view ('post.edit', compact('post'));
    }

    public function updatePost(Request $request, $id){
        $post = Post::findOrFail($id);
        $data = $request->all();
        $post->post_name = $data['post_name'];
        $post->post_content = $data['post_content'];

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('post'), $imageName);
        $post->image = $imageName;

        $post->save();
        return redirect()->back();
    }

    public function deletePost($id){
        $post = Post::findOrFail($id);
        $post->delete();

        $image_path = 'post/';

        if(!empty($post->image)){
            if(file_exists($image_path.$post->image)){
                unlink($image_path.$post->image);
            }
        }

            return redirect()->back();
        }
}

