
@extends('layouts.petfood')

@section('content')
<div class="container">
    <h2>Giỏ hàng</h2>
    @if(session('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] * $item['quantity'] }} VNĐ</td>
                        <td>
                            <form action="/cart/remove/{{ $id }}" method="POST">
                                @csrf
                                <button class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Tổng cộng:</strong> {{ $total }} VNĐ</p>
        <a href="/checkout" class="btn btn-primary">Thanh toán</a>
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
    @endif
</div>
@endsection