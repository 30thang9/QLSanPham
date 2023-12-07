<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}">Trang chủ</a>
    
    @if(auth()->check()) 
        <span class="navbar-text text-danger mx-3">
            Xin chào, {{ auth()->user()->name }}!
        </span>
        <!-- <a class="navbar-brand" href="{{ url('/logout') }}">Đăng xuất</a> -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="border:none; outline:none;margin-right:1.5rem">Đăng xuất</button>
        </form>

    @else
        <a class="navbar-brand" href="{{ url('/login') }}">Đăng nhập</a>
        <a class="navbar-brand" href="{{ url('/register') }}">Đăng ký</a>
    @endif
    
    <a class="navbar-brand" href="{{ url('/product-list') }}">Danh sách sản phẩm</a>
</nav>