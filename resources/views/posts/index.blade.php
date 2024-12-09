<x-layout>
   <body>
     
         <form action="/search" method="get">
            <input type="text" name="query" >
            <button type="submit">Search</button>
         </form>
     


      <div class="posts-container">
         <?php foreach ($posts as $post): ?>
            <article class="post-card">
               <h1>
                  <a href="/posts/{{$post->slug}}">
                     {!!$post->title !!}   
                  </a>
               </h1>
               <p>
                  By <a href="/authors/{{$post->author->id}}">{{$post->author->name}}</a>
                  in <a href="/?categories/{{$post->category->slug}}">{{$post->category->name }}</a>
               </p>
               <div>
                  <?= $post->body; ?><br>
                  <strong><?= $post->excerpt; ?></strong>
               </div>

               <!-- 图片展示区域 -->
               <div class="post-image-container">
                  @if(!empty($post->image_url))
                     <img src="/storage/{{ $post->image_url }}" alt="Post Image" class="post-image">
                  @else
                     <div class="image-placeholder">No Image</div>
                  @endif
               </div>
            </article>
         <?php endforeach; ?>
      </div>
   </body>
</x-layout>

<style>
/* 博客列表容器，使用Flex布局展示两列 */
.posts-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; 
    justify-content: space-between; 
}

/* 每个博客的容器样式 */
.post-card {
    width: 48%; 
    border: 1px solid #ddd;  
    padding: 15px; 
    border-radius: 8px; 
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
    box-sizing: border-box;
}

/* 图片展示区域 */
.post-image-container {
    width: 100%;
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    margin-bottom: 15px;
}

.post-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.image-placeholder {
    background-color: #e0e0e0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #888;
    font-size: 14px;
    font-weight: bold;
}

/* 小屏幕设备时调整为单列展示 */
@media (max-width: 768px) {
    .post-card {
        width: 100%; 
    }
}

form input[disabled] {
    background-color: #f0f0f0;
    cursor: not-allowed;
}
</style>
