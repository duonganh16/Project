@extends('layouts.app') {{-- nếu chưa có layout thì có thể bỏ dòng này --}}

@section('content')
<div class="container">
    <h1>Danh sách sản phẩm</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($product->image)
                        <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text text-danger"><strong>{{ number_format($product->price, 0) }}₫</strong></p>
                        <a href="/product/{{ $product->id }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
