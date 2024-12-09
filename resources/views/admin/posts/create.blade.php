<x-layout>
    <section>
        <main class="post-form-container">
            <h1 class="post-title">New Posts</h1>
            <form method="POST" action="/admin/posts" enctype="multipart/form-data" class="post-form">
                @csrf
                <x-form.input name="title" class="form-input" />
                <x-form.input name="slug" class="form-input" />
                <x-form.input name="image_url" type="file" class="form-input" />
                <x-form.textarea name="excerpt" class="form-textarea" />
                <x-form.textarea name="body" class="form-textarea" />

                <!-- 地理位置选择 -->
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" name="latitude" id="latitude" readonly class="form-input" />
                </div>
                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" name="longitude" id="longitude" readonly class="form-input" />
                </div>

                <!-- 分类选择 -->
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" id="category_id" class="form-input">
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{ ucwords($category->name) }}</option>    
                        @endforeach
                    </select>
                    @error('category')
                        <p>{{$message}}</p>
                    @enderror
                </div>

                <x-submit-button class="submit-button">Publish</x-submit-button>
            </form>
        </main>
    </section>

    <script>
        window.onload = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>

    <style>
        /* 整体页面容器 */
        .post-form-container {
            max-width: 768px; /* 设置为平板设备的宽度 */
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

        /* 表单容器，可滚动 */
        .post-form {
            max-height: 600px;
            overflow-y: auto; 
            padding-right: 20px; 
        }

        /* 表单输入框 */
        .form-input, .form-textarea, .form-group select {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 0.95rem;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        /* 输入框焦点状态 */
        .form-input:focus, .form-textarea:focus, .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }

        /* 表单文本区域 */
        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* 提交按钮 */
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

        /* 错误信息样式 */
        .form-group p {
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

            .form-input, .form-textarea, .form-group select {
                font-size: 0.9rem;
            }

            .submit-button {
                font-size: 1rem;
                padding: 12px;
            }
        }
    </style>

</x-layout>
