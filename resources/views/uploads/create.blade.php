<x-layout>
    <style>
        /* 文件信息容器 */
        .file-info {
            background-color: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .file-info a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }

        .file-info img {
            max-width: 100%; /* 确保图片适应容器 */
            height: auto;
            margin-top: 15px;
            border-radius: 8px;
        }

        /* 返回按钮 */
        .back-btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1.1rem;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }

        /* 文件信息文字样式 */
        .file-info p {
            font-size: 1rem;
            color: #333;
        }

        /* 错误信息 */
        .error-message {
            color: #e74c3c;
            font-size: 1rem;
        }
    </style>

    @if(!empty($id))
        <div class="file-info">
            <a href="{{ url('/storage/' . $path) }}">
                {{ $id }} {{ $originalName }}
            </a>
            <br>
            @if(substr($mimeType, 0, 5) == 'image')
                <img src="{{ url('/storage/' . $path) }}" alt="Image preview">
            @endif
        </div>
    @else
        <p class="error-message">File information is not available.</p>
    @endif

    <a href="{{ url('/') }}" class="back-btn">Back to see posts</a>

    @isset($id)
        <div class="file-info">
            <p><strong>View file information:</strong></p>
            {{ $id }}<br>
            {{ $path }}<br>
            {{ $originalName }}<br>
            {{ $mimeType }}
        </div>
    @endisset
</x-layout>
