<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostComment;

class PostController extends Controller
{
    // action to return a view containing a form for blog post creation
    public function create() {
    	// view((Folder Name).(File Name))
    	return view('posts.create');
    }

    // action to receive a from data and sotre athe data in the posts table
    // this action needs a parameter of class Request
    public function store(Request $request) {

    	// if there is an authenticated user
    	if(Auth::user()) {

    		// instantiate a new Post object from the Post models
    		$post = new Post;

    		// define the properties of the $post object using the recieved data
    		$post->title = $request->input('title');
    		$post->content = $request->input('content');

    		// get the id of the authenticated user and set it as the FK user_id of the new post
    		$post->user_id = (Auth::user()->id);

    		// asves the post in the database
    		$post->save();

    		return redirect('/posts');
    	}
    	else {
    		return redirect('/login');
    	}

    }

    public function index() {
    	$posts = Post::where('isActive', 1)->get();
        // $posts = Post::all();

    	return view('posts.index')->with('posts', $posts);
    }

    public function welcome() {
        $posts = Post::inRandomOrder()->limit(3)->where('isActive', 1)->get();
        return view('welcome')->with('posts', $posts);
    }

    // action for showing only the posts authored by the authenticated user
    public function myPosts() {
        
        if(Auth::user()) {
            $posts = Auth::user()->posts()->where('isActive', 1)->get();

            return view('posts.index')->with('posts', $posts);
        }
        else {
            return redirect('/login');
        }
    }

    // action that will return a view showing a specific post using the URL parameter $id to query
    public function show($id) {

        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    public function editpost($id) {
        if(Auth::user()) {
            $post = Post::find($id);
            if(Auth::user()->id == $post->user_id){
                
                return view('posts.edit')->with('post', $post);
            }
            else {
                return redirect('/myPosts');
            }
        }
        else {
            return redirect('/login');
        }
    }


    public function updatepost(Request $request, $id)
    {
        $this->validate($request, [
        'title' => 'required|max:255',
        'content' => 'required',
        ]);

        
        $post = Post::find($id);        

        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $post->update();

        return redirect('/myPosts');
    }

    // action to delete a specific post
    public function destroy($id) {

        $post = Post::find($id);
        

        if(Auth::user()->id == $post->user_id) {
            $post->delete();
        }

        return redirect('/posts');
    }

    public function archive($id)
    {
        $post = Post::find($id);
        
        //if authenticated user's ID is the same as the post's user_id
        if(Auth::user()->id == $post->user_id) {
            $post->isActive = 0;
            $post->update();  
        }

        return redirect('/myPosts');
    }

    // aciton that will allow an authenticated user who is not the post author to toggle a like on the post being viewed
    public function like($id) {

        $post = Post::find($id);
        $user_id = Auth::user()->id;

        // if th authenticated user is not the post author
        if($post->user_id != $user_id) {

            // checks if a post like has been made by this user before
            if($post->likes->contains("user_id", $user_id)) {

                // delete the like made by this user to unlike this post 
                PostLike::where('post_id', $post->id)->where('user_id', $user_id)->delete();
            }
            else {
                // create a new like record to like this post
                // instantiate a new PostLike object from the PostLike model
                $postLike = new PostLike;

                // define the properties of the $postLike object
                $postLike->post_id = $post->id;
                $postLike->user_id = $user_id;

                // save in the database
                $postLike->save();
            }

            return redirect("/posts/$id");
        }
    }

    public function comment(Request $request, $id) {

        $post = Post::find($id);
        $user_id = Auth::user()->id;

        $postComment = new PostComment;

        $postComment->post_id = $post->id;
        $postComment->user_id = $user_id;
        $postComment->content = $request->input('comment');

        $postComment->save();


        return redirect("/posts/$id");
    }
}
