<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
   public function index(){
    return view('admin.posts.index',[
      'posts' => Post::paginate(50)
    ]);
   }

   public function store()
   {

       
       $attributes = request()->validate([
           'title' => 'required',
           'image_url' => 'image', 
           'slug' => ['required', Rule::unique('posts', 'slug')],
           'excerpt' => 'required',
           'body' => 'required',
           'category_id' => ['required', Rule::exists('categories', 'id')],
           'latitude' => 'nullable|numeric',
           'longitude' => 'nullable|numeric'
       ]);
   
       $attributes['user_id'] = auth()->id();
       if (request()->hasFile('image_url') && request()->file('image_url')->isValid()) {
       $attributes['image_url'] = request()->file('image_url')->store('img');}
       
       Post::create($attributes);
       // check update img
       if (request()->hasFile('image_url') && request()->file('image_url')->isValid()) {
           $upload = new Upload();
   
         
           $upload->mimeType = request()->file('image_url')->getMimeType();
           $upload->originalName = request()->file('image_url')->getClientOriginalName();
           $upload->path =$attributes['image_url'];
           $upload->save();
   
           // if success return view
           return view('uploads.create', [
               'id' => $upload->id,
               'path' => $upload->path,
               'originalName' => $upload->originalName,
               'mimeType' => $upload->mimeType
           ]);
       }else{
           return redirect('/');
     
       }
   
     
   
       
       // try {
       //     $attributes = request()->validate([
       //         'title' => 'required',
       //         'image_url' => 'required|image', 
       //         'slug' => ['required', Rule::unique('posts', 'slug')],
       //         'excerpt' => 'required',
       //         'body' => 'required',
       //         'category_id' => ['required', Rule::exists('categories', 'id')]
       //     ]);
       //     // dd($attributes);
       // } catch (\Illuminate\Validation\ValidationException $e) {
       //     $errors = $e->errors();
       //     dd($attributes);
       // }
   
       // $attributes['user_id'] = auth()->id();
      
       // $attributes['image_url'] = request()->file('image_url')->store('public/storage');
   
       // Post::create($attributes);
   
       // return redirect('/');

   }

   public function edit(Post $post){
    return view('admin.posts.edit',['post'=>$post]);
   }

//    public function update(Post $post)
// {
//     $attributes = request()->validate([
//         'title' => 'required',
//         'image_url' => 'image', 
//         'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
//         'excerpt' => 'required',
//         'body' => 'required',
//         'category_id' => ['required', Rule::exists('categories', 'id')]
//     ]);

//     if(isset($attributes['image_url'])){
//         $attributes['image_url'] = request()->file('image_url')->store('img');}
    
//     $post->update($attributes);

//     return back()->with('success','updated');
// }  

public function update(Post $post)
{
    $attributes = request()->validate([
        'title' => 'required',
        'image_url' => 'image', 
        'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
        'excerpt' => 'required',
        'body' => 'required',
        'category_id' => ['required', Rule::exists('categories', 'id')]
    ]);

    if (request()->hasFile('image_url') && request()->file('image_url')->isValid()) {
        $attributes['image_url'] = request()->file('image_url')->store('img');
        
        // Check if post already has an associated upload
        $upload = $post->upload;

        if (!$upload) {
            $upload = new Upload();
           
        }
        $upload->mimeType = request()->file('image_url')->getMimeType();
        $upload->originalName = request()->file('image_url')->getClientOriginalName();
        $upload->path = $attributes['image_url'];
        $upload->save();
    }

    $post->update($attributes);

    return back()->with('success', 'Updated');
}

public function destroy(Post $post){
    $post ->delete();

    return back()->with('success','deleted');
}
}
