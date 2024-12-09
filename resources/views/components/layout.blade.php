<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Post</title>
    <style>
        /* 顶部导航样式 */
        .custom-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid #ccc;
            font-family: 'Open Sans', sans-serif;
        }
        .custom-nav img {
            height: 45px;
        }
        .custom-nav h1 {
            font-family: 'Special Elite', cursive;
            font-size: 24px;
            margin: 0;
        }
        .custom-nav .auth-links span,
        .custom-nav .auth-links a {
            margin-left: 10px;
            text-decoration: none;
            color: #222222;
        }
      .custom-nav .subscribe-btn {
    padding: 5px 15px;
    border-radius: 5px;
    background-color: #3490dc;
    text-decoration: none;
    font-size: 14px;
}

        /* 主标题样式 */
        .main-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
            text-align: center;
        }
        .main-header .rating-box {
            background: #f7f7f7;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px 10px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .main-header h1 {
            font-size: 48px;
            font-weight: bold;
            margin: 0;
        }

        /* 底部表单 */
        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px 0;
            background: #f8f9fa;
        }
        footer h5 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        footer p {
            font-size: 14px;
            margin-bottom: 20px;
        }
        footer form {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        footer form input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            width: 300px;
        }
        footer form button {
            background-color: #3490dc;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        footer form button:hover {
            background-color: #2176bd;
        }


    </style>
</head>
<body>
    <!-- 顶部导航 -->
    <nav class="custom-nav">
        
        <div class="auth-links">
          @auth
    <span>Welcome, {{ auth()->user()->name }}!</span>
    <form method="POST" action="/logout" style="display: inline-block;">
        @csrf
        <button type="submit" style="background: none; border: none; color: #3490dc; cursor: pointer;">Log Out</button>
    </form>

    <!-- 如果是 admin 或其他角色，可以看到 Update 按钮 -->
    @role('admin')
        <a href="/admin/posts/publish" class="subscribe-btn">Update</a>
    @else
        <!-- 如果不是 editor，则显示 Update 按钮 -->
        @if(auth()->user()->hasRole('admin') || !auth()->user()->hasRole('editor'))
            <a href="/admin/posts/publish" class="subscribe-btn">Update</a>
        @endif
    @endrole

    <!-- 只显示编辑按钮给 editor 和 admin -->
    @role('admin')
        <a href="/admin/posts">Edit</a>
    @endrole

    @role('editor')
        <a href="/admin/posts">Edit</a>
    @endrole
@endauth

@guest
    <a href="/register">Register</a>
    <a href="/login">Log In</a>
@endguest

       

        <a href="/index" class="subscribe-btn">Posts</a>
                
        
            
        </div>
    </nav>

    <!-- 主标题 -->
    <header class="main-header">
        <div class="rating-box">Finished at-Nov 29,2024</div>
        <h1>MAP IMPACT</h1>
    </header>

    <!-- 内容插槽 -->
    <section>
        {{ $slot }}
    </section>

   <footer>
   
   </footer>
   

    <x-flash />
</body>
</html>

