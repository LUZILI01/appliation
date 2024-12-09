@props(['heading'])

<style>
/* 整体容器样式 */
section {
    padding: 40px 20px; /* 增加上下内边距，适配各种设备 */
    max-width: 1200px;   /* 适当扩大最大宽度 */
    margin: 0 auto;      /* 居中对齐 */
    background-color: #f4f4f4; /* 设置背景色 */
}

/* 标题样式 */
section h1 {
    font-size: 1.875rem;  /* 设置字体大小 */
    font-weight: bold;
    margin-bottom: 24px;   /* 增加底部间距 */
    padding-bottom: 8px;   /* 增加底部内边距 */
    border-bottom: 3px solid #3490dc;  /* 设置底部边框 */
    color: #333;
}

/* Flexbox布局，确保主内容自适应宽度 */
.flex {
    display: flex;
    justify-content: space-between; /* 使内容之间有间距 */
    gap: 30px;  /* 添加间距 */
}

/* 主体区域样式 */
main {
    flex: 1;
}

/* 卡片样式 */
main .border {
    border: 1px solid #ddd;  /* 设置边框颜色 */
    padding: 30px;  /* 内边距 */
    border-radius: 12px; /* 圆角效果 */
    background-color: #fff;  /* 背景色 */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 添加阴影效果 */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* 过渡效果 */
}

/* 鼠标悬停时，卡片效果 */
main .border:hover {
    transform: translateY(-5px); /* 鼠标悬停时，轻微上移 */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* 加强阴影 */
}

/* 响应式设计 */
@media (max-width: 768px) {
    section {
        padding: 20px; /* 调整内边距 */
    }

    section h1 {
        font-size: 1.5rem; /* 适配小屏幕 */
    }

    .flex {
        flex-direction: column; /* 小屏幕下，将flex方向变为纵向 */
    }

    .flex > * {
        width: 100%; /* 让子元素在小屏幕下占满宽度 */
    }
}

</style>

<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>

    <div class="flex">

        <main class="flex-1">
            <div {{ $attributes(['class' => 'border border-gray-200 p-6 rounded-xl']) }}>
                {{ $slot }}
            </div>
        </main>
    </div>
</section>
<script>
    function showLinks() {
        document.getElementById('linksList').style.display = 'block';
    }

    function hideLinks() {
        document.getElementById('linksList').style.display = 'none';
    }
</script>