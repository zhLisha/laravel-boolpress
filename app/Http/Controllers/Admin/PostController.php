<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::all();

        $page_request = $request->all();
        // dd($page_request);
        $deleted_post = isset($page_request['deleted']) ? $page_request['deleted'] : null;

        $data = [
            'posts' => $posts,
            'deleted' => $deleted_post
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        $form_data = $request->all();

        $new_post = new Post();

        $new_post->title = $form_data['title'];
        $new_post->content = $form_data['content'];
        $new_post->category_id = $form_data['category_id'];

        $new_post->slug = $this->getIncreasedSlug($new_post->title);

        $new_post->save();

        // dd($form_data);

        $new_post->tags()->sync($form_data['tags']);

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::all();

        $translate_date = Carbon::setlocale('it-IT');

        $data = [
            'post' => $post,
            'tags' => $tags
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form_data = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'post' => $form_data,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', $data);
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
        $request->validate($this->getValidationRules());

        $post_to_update = Post::findOrFail($id);
        
        $form_data = $request->all();

      
        if($post_to_update->title !== $form_data['title']) {
            $form_data['slug'] = $this->getIncreasedSlug($form_data['title']);
        } else {
            $form_data['slug'] = $post_to_update->slug;
        }

        $post_to_update->category_id =  $form_data['category_id'];

        $post_to_update->update($form_data);

        
        if(isset($form_data['tags'])) {
            $post_to_update->tags()->sync($form_data['tags']);
        } 
        else {
            $post_to_update->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::findOrFail($id);
        $post_to_delete->tags()->sync([]);
        $post_to_delete->delete();

        return redirect()->route('admin.posts.index', ['deleted' => 'yes']);
    }


    // ************************
    // Function
    // ************************
    protected function getIncreasedSlug($title) {
        $save_new_slug = Str::slug($title , '-');
        $base_slug = $save_new_slug ;
        $find_existing_slug = Post::where('slug', '=', $save_new_slug)->first();

        $counter = 1;

        while($find_existing_slug) {
            $save_new_slug = $base_slug . '-' . $counter;

            $find_existing_slug = Post::where('slug', '=', $save_new_slug)->first();

            $counter++;
        };

        return $save_new_slug;
    }

    public function getValidationRules() {
        return [
            'title' => 'required | max:250',
            'content' => 'required | max:60000',
            'category_id' => 'nullable | exists:categories,id'
        ];
    }
}
