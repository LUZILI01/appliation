@props(['name'])
<div class="form-group">
    <x-form.label name="{{$name}}" />

    <textarea class="form-textarea"
              name="{{$name}}"
              id="{{$name}}"
              required
    >{{$slot ?? old($name)}}</textarea>
    
    <x-form.error name="{{$name}}" />
</div>

<style>
    /* 表单组容器 */
    .form-group {
        margin-bottom: 20px; /* 输入框和下一项之间的间距 */
    }

    /* 文本区域 */
    .form-textarea {
        width: 100%;
        padding: 12px;
        margin-top: 6px; /* 文本框和标签之间的间距 */
        border: 1px solid #ccc;
        border-radius: 8px; /* 圆角边框 */
        font-size: 1rem; /* 字体大小 */
        box-sizing: border-box;
        background-color: #fff;
        resize: vertical; /* 支持垂直方向调整大小 */
        transition: border-color 0.3s ease-in-out;
    }

    /* 文本区域焦点状态 */
    .form-textarea:focus {
        border-color: #007bff;
        outline: none;
    }

    /* 错误信息 */
    .form-group .error {
        color: #e74c3c;
        font-size: 0.875rem; /* 错误信息字体 */
        margin-top: 5px;
    }

    /* 标签样式 */
    .form-label {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px; /* 标签和输入框之间的间距 */
    }
</style>
