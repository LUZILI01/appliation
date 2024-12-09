<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\Post;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserLocationController;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use App\Http\Controllers\FooterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('posts/index',[
        'posts' =>Post::latest()->with(['category','author'])->get()
    ]);
});


Route::get('uploads/create',[PostController::class,'create']);

Route::post('admin/posts',[PostController::class,'store'])->middleware('admin');

Route::get('/uploads/{upload}/{originalName?}',[PostController::class,'show']);

Route::get('register',[RegisterController::class,'create'])->middleware('guest');

Route::post('register',[RegisterController::class,'store'])->middleware('guest');

Route::get('login',[SessionsController::class,'create'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::post('login',[SessionsController::class,'store'])->middleware('guest');

Route::get('admin/posts/publish',[PostController::class,'create'])->middleware('admin');




Route::get('index', function () {

    
        return view('posts/index',[
            'posts' =>Post::latest()->with(['category','author'])->get()
        ]);
       
    });
    Route::get('posts/{post:slug}', function (Post $post, Upload $uploads) {
        return view('posts.show', [
            'post' => $post,
            'uploads' => $uploads
        ]);
    });
    
    
    Route::get('categories/{slug}',function(Category $category){
        return view('posts/index',[
            'posts' =>Post::all()
        ]);
    });
    
    Route::get('authors/{author}',function(User $author){
        return view('posts/index',[
            'posts' =>$author->posts
        ]);
    });
    
   
    Route::post('admin/posts',[AdminPostController::class,'store'])->middleware('admin');

    Route::get('admin/posts',[AdminPostController::class,'index'])->middleware('admin');

    Route::get('admin/posts/create',[AdminPostController::class,'index'])->middleware('admin');

    Route::get('admin/posts/{post}/edit',[AdminPostController::class,'edit'])->middleware('admin');

    Route::patch('admin/posts/{post}',[AdminPostController::class,'update'])->middleware('admin');

    Route::delete('admin/posts/{post}',[AdminPostController::class,'destroy'])->middleware('admin');

    Route::get('/search', [SearchController::class, 'index']);

    Route::post('/save-location', [UserLocationController::class, 'store']);

    Route::get('/get-locations', [UserLocationController::class, 'getLocations']);

    Route::get('/get-cluster-data', [PostController::class, 'getClusterData']);

 

    // Route::post('/search', [SearchController::class, 'index'])->name('search.index');