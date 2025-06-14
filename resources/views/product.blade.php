<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
</head>
<body>
    <h1>{{ $product->name }}</h1>

    <p><strong>Mô tả:</strong> {{ $product->description }}</p>
    <p><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }} đ</p>

    <a href="/">← Quay về danh sách sản phẩm</a>
</body>
</html>
