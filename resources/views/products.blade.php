@extends('layouts.petfood')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Tất cả sản phẩm</h2>

            {{-- Search and Filter Section --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="/products" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2"
                               placeholder="Tìm kiếm sản phẩm..."
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <p class="text-muted">Tìm thấy {{ $products->total() }} sản phẩm</p>
                </div>
            </div>

            {{-- Products Grid --}}
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            @if($product->image)
                                @if(filter_var($product->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $product->image }}"
                                         class="card-img-top"
                                         alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         class="card-img-top"
                                         alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">
                                @endif
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                     style="height: 200px;">
                                    <span class="text-muted">Không có hình ảnh</span>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>

                                @if($product->description)
                                    <p class="card-text text-muted small">
                                        {{ Str::limit($product->description, 100) }}
                                    </p>
                                @endif

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="h5 text-success mb-0">
                                            {{ number_format($product->price) }} VNĐ
                                        </span>
                                        <div class="btn-group" role="group">
                                            <a href="/product/{{ $product->id }}"
                                               class="btn btn-outline-primary btn-sm">
                                                Chi tiết
                                            </a>
                                            @auth
                                                <form action="/cart/add/{{ $product->id }}"
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        Thêm vào giỏ
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                                                    Đăng nhập
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <h4>Không tìm thấy sản phẩm nào</h4>
                            <p class="text-muted">Hãy thử tìm kiếm với từ khóa khác hoặc xem tất cả sản phẩm.</p>
                            <a href="/products" class="btn btn-primary">Xem tất cả sản phẩm</a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
