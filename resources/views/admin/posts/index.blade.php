<style>
section {
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
    background-color: #f4f4f4;
}

/* 表格容器样式 */
table {
    width: 100%;
    border-collapse: collapse; /* 合并表格边框 */
    margin-top: 20px; /* 顶部间距 */
    background-color: #fff; /* 表格背景色 */
    border-radius: 8px; /* 圆角边框 */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 添加阴影效果 */
}

/* 表格头部样式 */
thead {
    background-color: #3490dc; /* 设置表头背景色 */
    color: #fff; /* 字体颜色 */
    font-size: 1.1rem;
}

thead th {
    padding: 12px; /* 内边距 */
    text-align: left; /* 左对齐 */
    font-weight: bold;
}

/* 表格单元格样式 */
tbody td {
    padding: 12px;
    border-bottom: 1px solid #ddd; /* 底部边框 */
}

/* 表格链接样式 */
tbody td a {
    color: #3490dc; /* 设置链接颜色 */
    text-decoration: none; /* 去除下划线 */
}

tbody td a:hover {
    text-decoration: underline; /* 悬停时显示下划线 */
}

/* 表格按钮样式 */
button {
    padding: 6px 12px;
    background-color: #e74c3c; /* 设置删除按钮颜色 */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #c0392b; /* 悬停时按钮颜色变深 */
}

/* 编辑链接样式 */
a {
    color: #007bff; /* 设置编辑按钮颜色 */
    text-decoration: none;
}

a:hover {
    text-decoration: underline; /* 悬停时显示下划线 */
}

/* 响应式设计 */
@media (max-width: 768px) {
    table {
        width: 100%;
        font-size: 0.9rem; /* 调整字体大小 */
    }

    th, td {
        padding: 10px; /* 增加内边距 */
    }

    button {
        font-size: 0.9rem; /* 调整按钮字体大小 */
    }
}
</style>
<x-layout>
    <x-form.setting heading="Manage Posts">
        <div>
            <div>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th class="text-right">Edit</th>
                                <th class="text-right">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        <a href="/posts/{{ $post->slug }}">
                                            {{ $post->title }}
                                        </a>
                                    </td>
                                    <td class="text-right">
                                        <a href="/admin/posts/{{ $post->id }}/edit">Edit</a>
                                    </td>
                                    <td class="text-right">
                                        <form method="POST" action="/admin/posts/{{ $post->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-form.setting>
</x-layout>
