<x-layout>
    <h1 class="search-results-title">Search Results</h1>

    @if ($posts->isEmpty())
        <p class="no-results">No matching results found.</p>
    @else
        <div class="post-list">
            @foreach ($posts as $post)
                <?php
                    $query = isset($_GET['query']) ? $_GET['query'] : '';
                    $titleSimilarity = similar_text(mb_strtolower($query), mb_strtolower(substr($post->title, 0, 5)));
                ?>

                @if ($titleSimilarity >= 3)
                    <article class="post-item">
                        <h2>
                            <a href="/posts/{{$post->slug}}" class="post-title">
                                {!!$post->title !!}   
                                @if(!empty($post->image_url))
                                    <strong class="has-photo">has photo</strong>
                                @endif
                            </a>
                        </h2>
                        <p class="post-meta">
                            By <a href="/authors/{{$post->author->id}}" class="author-name">{{$post->author->name}}</a>
                            in <a href="/?categories/{{$post->category->slug}}" class="category-name">{{$post->category->name }}</a>
                        </p>
                        <div class="post-body">
                            {!! $post->body !!}<br>
                            <strong>{!! $post->excerpt !!}</strong>
                        </div>
                    </article>
                @endif
            @endforeach
        </div>
    @endif
</x-layout>

<style>
/* 搜索结果标题 */
.search-results-title {
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 20px;
}

/* 无匹配结果信息 */
.no-results {
    text-align: center;
    font-size: 1.2rem;
    color: #888;
}

/* 文章列表 */
.post-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

/* 单个文章项 */
.post-item {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 15px;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.post-item:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* 文章标题 */
.post-title {
    font-size: 1.5rem;
    color: #007bff;
    text-decoration: none;
}

.post-title:hover {
    text-decoration: underline;
}

/* 文章元信息 */
.post-meta {
    font-size: 0.9rem;
    color: #555;
    margin-bottom: 10px;
}

.author-name,
.category-name {
    color: #007bff;
    text-decoration: none;
}

.author-name:hover,
.category-name:hover {
    text-decoration: underline;
}

/* 文章内容 */
.post-body {
    font-size: 1rem;
    color: #333;
}

.has-photo {
    font-weight: bold;
    color: #28a745;
    margin-left: 10px;
}
</style>

