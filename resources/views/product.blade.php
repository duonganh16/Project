
@extends('layouts.petfood')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            {{-- Product Image --}}
            @if($product->image)
                @if(filter_var($product->image, FILTER_VALIDATE_URL))
                    <img src="{{ $product->image }}"
                         class="img-fluid rounded"
                         alt="{{ $product->name }}"
                         style="width: 100%; max-height: 500px; object-fit: cover;">
                @else
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="img-fluid rounded"
                         alt="{{ $product->name }}"
                         style="width: 100%; max-height: 500px; object-fit: cover;">
                @endif
            @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                     style="height: 400px;">
                    <span class="text-muted h4">Không có hình ảnh</span>
                </div>
            @endif
        </div>

        <div class="col-md-6">
            {{-- Product Details --}}
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ $product->name }}</h2>

                    @if($product->description)
                        <div class="mb-3">
                            <h5>Mô tả sản phẩm:</h5>
                            <p class="card-text">{{ $product->description }}</p>
                        </div>
                    @endif

                    <div class="mb-4">
                        <h3 class="text-success">{{ number_format($product->price) }} VNĐ</h3>
                    </div>

                    @auth
                        <form action="/cart/add/{{ $product->id }}" method="POST" class="mb-3">
                            @csrf
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="mb-3">
                            <div class="d-grid gap-2">
                                <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                                    <i class="fas fa-sign-in-alt"></i> Đăng nhập để mua hàng
                                </a>
                            </div>
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    Chưa có tài khoản?
                                    <a href="{{ route('register') }}" class="text-decoration-none">Đăng ký ngay</a>
                                </small>
                            </div>
                        </div>
                    @endauth

                    <div class="d-grid gap-2">
                        <a href="/products" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại danh sách sản phẩm
                        </a>
                        <a href="/" class="btn btn-outline-primary">
                            <i class="fas fa-home"></i> Về trang chủ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection