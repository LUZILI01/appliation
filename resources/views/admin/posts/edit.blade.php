<x-layout>
    <section>
        <main class="post-form-container">
            <h1 class="post-title">
                Editing: {{ $post->title }}
            </h1>
            <form method="POST" action="/admin/posts/{{$post->id}}" enctype="multipart/form-data" class="post-form">
                @csrf
                @method('PATCH')

                <x-form.input name="title" :value="old('title', $post->title)" class="form-input" />
                <x-form.input name="slug" :value="old('slug', $post->slug)" class="form-input" />

                <div class="form-group">
                    <x-form.input name="image_url" type="file" :value="old('image_url', $post->image_url)" class="form-input" />
                    <a href="{{ url('/storage/' . $post->image_url) }}">
                        <img height="25%" width="25%" src="{{ url('/storage/' . $post->image_url) }}" alt="Sorry, pictures fly away/do not have a picture">
                    </a>
                </div>

                <x-form.textarea name="excerpt" class="form-textarea">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
                <x-form.textarea name="body" class="form-textarea">{{ old('body', $post->body) }}</x-form.textarea>

                <div class="form-group">
                    <label for="category" class="form-label">
                        Category
                    </label>
                    <select name="category_id" id="category_id" class="form-input">
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}>
                                {{ ucwords($category->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                </div>

                <x-submit-button class="submit-button">Update Post</x-submit-button>
            </form>
        </main>
    </section>

    <style>
        /* 表单容器和整体布局 */
        .post-form-container {
            max-width: 768px;
            margin: 30px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* 标题样式 */
        .post-title {
            font-size: 1.8rem;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        /* 表单容器 */
        .post-form {
            max-height: 600px;
            overflow-y: auto;
            padding-right: 20px;
        }

        /* 表单输入框和文本框 */
        .form-input, .form-textarea {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 0.95rem;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        /* 输入框聚焦效果 */
        .form-input:focus, .form-textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        /* 提交按钮样式 */
        .submit-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 1.1rem;
            cursor: pointer;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }

        /* 错误消息样式 */
        .form-error {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        /* 响应式设计 */
        @media (max-width: 768px) {
            .post-form-container {
                padding: 15px;
            }

            .post-title {
                font-size: 1.6rem;
            }

            .form-input, .form-textarea {
                font-size: 0.9rem;
            }

            .submit-button {
                font-size: 1rem;
                padding: 12px;
            }
        }
    </style>
</x-layout>
