
@extends('layouts.petfood')

@section('content')
<div class="container">
    <h2 class="mb-4">Sản phẩm nổi bật</h2>

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        @if(filter_var($product->image, FILTER_VALIDATE_URL))
                            <img src="{{ $product->image }}"
                                 class="card-img-top"
                                 alt="{{ $product->name }}"
                                 style="height: 250px; object-fit: cover;">
                        @else
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="card-img-top"
                                 alt="{{ $product->name }}"
                                 style="height: 250px; object-fit: cover;">
                        @endif
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                             style="height: 250px;">
                            <span class="text-muted">Không có hình ảnh</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                        <div class="mt-auto">
                            <p class="card-text"><strong class="text-success">{{ number_format($product->price) }} VNĐ</strong></p>
                            <div class="d-grid gap-2">
                                <a href="/product/{{ $product->id }}" class="btn btn-outline-primary">Xem chi tiết</a>
                                @auth
                                    <form action="/cart/add/{{ $product->id }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success w-100">Thêm vào giỏ</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-success w-100">
                                        Đăng nhập để mua hàng
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
