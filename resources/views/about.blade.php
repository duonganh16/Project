
@extends('layouts.petfood')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="mb-4">Giới thiệu về PetFood Shop</h2>

            <div class="card">
                <div class="card-body">
                    <h4>Chào mừng đến với PetFood Shop!</h4>
                    <p class="lead">Chúng tôi là cửa hàng chuyên cung cấp thức ăn chất lượng cao cho thú cưng của bạn.</p>

                    <h5>Sứ mệnh của chúng tôi</h5>
                    <p>Mang đến những sản phẩm dinh dưỡng tốt nhất cho thú cưng, giúp chúng khỏe mạnh và hạnh phúc.</p>

                    <h5>Cam kết chất lượng</h5>
                    <ul>
                        <li>Sản phẩm chính hãng, có nguồn gốc rõ ràng</li>
                        <li>Giá cả cạnh tranh, ưu đãi hấp dẫn</li>
                        <li>Giao hàng nhanh chóng, đóng gói cẩn thận</li>
                        <li>Hỗ trợ khách hàng 24/7</li>
                    </ul>

                    <div class="text-center mt-4">
                        <a href="/" class="btn btn-primary">Xem sản phẩm</a>
                        <a href="/contact" class="btn btn-outline-primary">Liên hệ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection