<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Access\Response;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use App\Models\Upload;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        return view('posts.index',[
            'posts'=>Post::latest()->filter(
                request(['search','category','author'])
            )->paginate(18)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show',[
            'post'=>$post
        ]);

      
    }  
    public function create(){
    
        return view('admin.posts.create');

        }

        public function getClusterData()
        {
            // 查询数据并组合为需要的格式
            $data = Post::join('users', 'posts.user_id', '=', 'users.id')
                        ->select('users.name', 'posts.latitude', 'posts.longitude')
                        ->whereNotNull('posts.latitude')
                        ->whereNotNull('posts.longitude')
                        ->get();
        
            return response()->json($data);
        }
        


        

    //     public function store(Request $request){
        
    //         $attributes=request()->validate([
    //             'title'=>'required',
    //             'slug'=>['required',Rule::unique('posts','slug')],
    //             'excerpt'=>'required',
    //             'body'=>'required',
    //             'category_id'=>['required',Rule::exists('categories','id')]
    //         ]);

    //         $attributes['user_id']=auth()->id();



    //         Post::create($attributes);

            
    //         if ($request->hasFile('upload') && $request->file('upload')->isValid()) {
    //             $upload = new Upload();
        
    //             // 获取 MIME 类型
    //             $upload->mimeType = $request->file('upload')->getMimeType();
    //             $upload->originalName = $request->file('upload')->getClientOriginalName();
    //             $upload->path = $request->file('upload')->store('uploads');
    //             $upload->save();
        
    //             // 如果文件上传成功，返回相关信息视图
    //             return view('uploads.create', [
    //                 'id' => $upload->id,
    //                 'path' => $upload->path,
    //                 'originalName' => $upload->originalName,
    //                 'mimeType' => $upload->mimeType
    //             ]);
    //         }

    // return redirect('/');

         
        // }

}

?>