<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class MustBeAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 获取当前用户
        $user = auth()->user();
    
        // 如果用户未登录，或者没有相应的权限
        if (!$user) {
            abort(HttpFoundationResponse::HTTP_FORBIDDEN, 'Access Denied');
        }

        if ($user && !$user->hasRole('editor') && $request->is('admin/posts/publish')||$request->is('admin/posts')||$request->is('admin/posts/*')) {
            return $next($request);
        }
        
        // 如果是 'admin' 用户，允许访问
        if ($user->name === 'admin') {
          
            return $next($request);
        }
    
        // 如果是 'editor' 用户，只能访问与编辑相关的功能
        if ($user->name === 'editor') {
            
            if ($request->is('admin/posts/*/edit')|| $request->is('admin/posts')) {
                return $next($request);
            }
    
           
            abort(HttpFoundationResponse::HTTP_FORBIDDEN, 'Access Denied');
        }
    
        // 如果用户是其他类型，直接拒绝访问
        abort(HttpFoundationResponse::HTTP_FORBIDDEN, 'Access Denied');
    }
    
}
