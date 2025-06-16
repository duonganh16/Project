
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text"><strong>Giá:</strong> {{ $product->price }} VNĐ</p>

                    <form action="/cart/add/{{ $product->id }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
                    </form>

                    <a href="/products" class="btn btn-secondary mt-3">Quay lại danh sách sản phẩm</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection