@props(['name', 'type' => 'text'])
<div class="form-group">
    <x-form.label name="{{$name}}" />
    
    @csrf
    <input class="form-input"
           type="{{$type}}"
           name="{{$name}}"
           id="{{$name}}"
           {{$attributes(['value'=>old($name)])}}
    >

    <x-form.error name="{{$name}}"/>
</div>

<style>
    /* 输入框和表单组样式 */
    .form-group {
        margin-bottom: 20px; /* 增加输入框和下一项之间的间距 */
    }

    .form-input {
        width: 100%;
        padding: 12px;
        margin-top: 6px; /* 提高输入框和标签之间的间距 */
        border: 1px solid #ccc;
        border-radius: 8px; /* 圆角边框 */
        font-size: 1rem; /* 输入框字体 */
        box-sizing: border-box;
        background-color: #fff;
        transition: border-color 0.3s ease-in-out;
    }

    /* 输入框焦点状态 */
    .form-input:focus {
        border-color: #007bff;
        outline: none;
    }

    /* 错误信息 */
    .form-group .error {
        color: #e74c3c;
        font-size: 0.875rem; /* 错误信息字体稍微小一点 */
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
