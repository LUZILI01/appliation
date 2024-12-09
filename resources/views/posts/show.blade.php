<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

</head>

<!-- 显示博客详情 -->
<x-layout>
    <article class="post-detail">
        <h1 class="post-title">
            <a href="/posts/{{$post->slug}}">
                {!! $post->title !!}
            </a>
        </h1>
        <p class="post-meta">
            By <a href="/authors/{{$post->author->id}}">{{$post->author->name}}</a>
            in <a href="/categories/{{$post->category->slug}}">{{$post->category->name }}</a>
        </p>

@if(isset($post->latitude) && isset($post->longitude))
    <div>
        <button id="toggle-map">switch</button>
    </div>
    <div id="map-container">
        <div id="map" style="width: 100%; height: 400px;"></div>
        <div id="cluster-map" style="width: 100%; height: 400px; display: none;"></div>
    </div>

    <script>
        // 默认地图初始化
        const map = L.map('map').setView([{{ $post->latitude }}, {{ $post->longitude }}], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        L.marker([{{ $post->latitude }}, {{ $post->longitude }}])
            .addTo(map)
            .bindPopup('<b>{{ $post->title }}</b><br>{{ $post->author->name }}')
            .openPopup();

        // 切换按钮逻辑
        const toggleMapBtn = document.getElementById('toggle-map');
        const mapDiv = document.getElementById('map');
        const clusterMapDiv = document.getElementById('cluster-map');

        toggleMapBtn.addEventListener('click', () => {
            const mapIsVisible = mapDiv.style.display !== 'none';
            if (mapIsVisible) {
                mapDiv.style.display = 'none';
                clusterMapDiv.style.display = 'block';
                initClusterMap(); // 初始化群聚地图
            } else {
                mapDiv.style.display = 'block';
                clusterMapDiv.style.display = 'none';
            }
        });

        // 群聚地图初始化
        let clusterMapInitialized = false;
        function initClusterMap() {
            if (clusterMapInitialized) return; // 防止重复初始化
            clusterMapInitialized = true;

            const clusterMap = L.map('cluster-map').setView([0, 0], 2); // 默认缩放显示全世界
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(clusterMap);

            const markers = L.markerClusterGroup();

            // 加载群聚数据 (需从后端获取)
            fetch('/get-cluster-data')
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        const marker = L.marker([item.latitude, item.longitude])
                            .bindPopup(`<b>${item.name}</b><br>${item.latitude}, ${item.longitude}`);
                        markers.addLayer(marker);
                    });
                    clusterMap.addLayer(markers);
                });
        }
    </script>
@endif

    </article>
</x-layout>


<style>
    /* 整体文章样式 */
    .post-detail {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
    }

    /* 标题样式 */
    .post-title {
        font-size: 2rem;
        color: #333;
        margin-bottom: 15px;
    }

    .post-title a {
        text-decoration: none;
        color: inherit;
    }

    .post-meta {
        font-size: 1rem;
        color: #777;
        margin-bottom: 20px;
    }

    /* 图片展示区域 */
    .post-image-container {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .post-image {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    /* 返回链接样式 */
    .back-link {
        display: inline-block;
        padding: 10px 15px;
        margin-top: 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        text-align: center;
    }

    .back-link:hover {
        background-color: #0056b3;
    }
</style>


