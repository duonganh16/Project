<!DOCTYPE html>
<html>
<head>
    <title>Pet Food Shop</title>
</head>
<body>
    <h1>🐾 Danh sách sản phẩm</h1>

    @foreach($products as $product)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <h2>{{ $product->name }}</h2>
            <p><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }} đ</p>
            <a href="/product/{{ $product->id }}">Xem chi tiết</a>
        </div>
    @endforeach
</body>
</html>
