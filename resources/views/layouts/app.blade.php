<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PetFood Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- Navigation bar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">PetFood Shop</a>
            <div>
                <a class="nav-link d-inline text-white" href="/products">Sản phẩm</a>
                <a class="nav-link d-inline text-white" href="/cart">Giỏ hàng</a>
                <a class="nav-link d-inline text-white" href="/about">Giới thiệu</a>
                <a class="nav-link d-inline text-white" href="/contact">Liên hệ</a>
            </div>
        </div>
    </nav>

    {{-- Nội dung động --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="text-center py-4 mt-5 bg-light">
        <small>&copy; 2025 PetFood Shop. All rights reserved.</small>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
