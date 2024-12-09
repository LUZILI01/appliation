<x-layout>

    <section class="login-section">
        <main class="login-main">
            <h1 class="login-title">Log In</h1>
     
            <form method="POST" action="/login" class="login-form">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">
                        Email
                    </label>

                    <input type="email"
                        name="email"
                        id="email"
                        value="{{old('email')}}"
                        required
                        class="form-input">

                    @error('email')
                        <p class="error-message">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <input type="password"
                        name="password"
                        id="password"
                        required
                        class="form-input"> 

                    @error('password')
                        <p class="error-message">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-btn">
                        Log In
                    </button>  
                </div>

                @if ($errors->any())
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li class="error-list-item">{{$error}}</li>
                        @endforeach
                    </ul> 
                @endif
            </form>
        </main>
    </section> 

</x-layout>

<style>
/* 登录表单区域 */
.login-section {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f7f7f7;
}

/* 主体部分 */
.login-main {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

/* 标题 */
.login-title {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 20px;
    color: #333;
}

/* 表单 */
.login-form {
    display: flex;
    flex-direction: column;
}

/* 表单项 */
.form-group {
    margin-bottom: 20px;
}

/* 标签 */
.form-label {
    font-size: 1rem;
    margin-bottom: 5px;
    color: #333;
}

/* 输入框 */
.form-input {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

/* 错误信息 */
.error-message {
    font-size: 0.9rem;
    color: red;
    margin-top: 5px;
}

/* 提交按钮 */
.submit-btn {
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1.1rem;
}

.submit-btn:hover {
    background-color: #0056b3;
}

/* 错误列表 */
.error-list {
    list-style: none;
    padding: 0;
    margin-top: 10px;
}

.error-list-item {
    font-size: 0.9rem;
    color: red;
}
</style>

