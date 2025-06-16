@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thanh toán</h2>

    <form action="/checkout" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ giao hàng</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Đặt hàng</button>
    </form>
</div>
@endsection