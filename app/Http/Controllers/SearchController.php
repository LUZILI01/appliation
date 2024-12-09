<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\SearchRecord;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;



class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $user = Auth::user(); 

        if (empty($user->id)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        // 调用 search 方法进行模糊查询
        $posts = $this->search($query);

        return view('search.index', ['posts' => $posts]);
    }

    /**
     * 模糊查询搜索文章
     */
    public function search($query)
    {
        // 使用 Laravel 的 Eloquent 查询构建器进行模糊查询
        return Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('body', 'like', '%' . $query . '%')  // 如果你也想在内容中搜索
            ->get();
    }
}
    
