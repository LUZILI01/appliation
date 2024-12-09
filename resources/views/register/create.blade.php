<x-layout>
    <section id="6">
      <main class="form-container">
        <h1 class="text-center font-bold text-xl">Register</h1>
      
         <form method="POST" action="/register" class="mt-10">
       @csrf  
       <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{old('name')}}" required>
            @error('name')
                <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="{{old('username')}}" required>
            @error('username')
                <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{old('email')}}" required>
            @error('email')
                <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required> 
            @error('password')
                <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="submit-btn">Submit</button>
        </div>

        @if ($errors->any())
          <ul class="error-list">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
          </ul> 
        @endif
        </form>
      </main>
    </section>
</x-layout>

<style>
/* 整体表单容器样式 */
.form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
}


.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}


.error-message {
    color: red;
    font-size: 0.875rem;
    margin-top: 5px;
}


.error-list {
    color: red;
    font-size: 0.875rem;
    list-style-type: none;
    padding-left: 0;
}


.submit-btn {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

.submit-btn:hover {
    background-color: #0056b3;
}
</style>

