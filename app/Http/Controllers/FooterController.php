<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FooterController extends Controller
{
    public function getApiResponse()
    {
        $apiUrl = "http://example.com/open/api/v2/trace/listByUuid?uuid=015123310098&time=2024-08-01%2014%3A25%3A14&pageSize=10";

        try {
            // 发起 API 请求
            $response = Http::get($apiUrl);

            // 检查响应是否成功
            if ($response->successful()) {
                $data = $response->json();  // 解析 JSON 数据
                // 将数据传递给视图
                return view('posts.index', ['footerData' => json_encode($data, JSON_PRETTY_PRINT)]);
            } else {
                return view('posts.index', ['footerData' => 'Error: ' . $response->status()]);
            }
        } catch (\Exception $e) {
            // 如果请求出错，捕获异常并返回错误信息
            return view('posts.index', ['footerData' => 'Error occurred: ' . $e->getMessage()]);
        }
    }
}
