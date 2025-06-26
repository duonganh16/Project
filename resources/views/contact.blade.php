@extends('layouts.petfood')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="mb-4">Liên hệ với chúng tôi</h2>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Gửi tin nhắn</h5>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên của bạn</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Tin nhắn</label>
                                    <textarea name="message" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Thông tin liên hệ</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Địa chỉ:</strong><br>
                            123 Đường ABC, Quận XYZ, TP.HCM</p>

                            <p><strong>Điện thoại:</strong><br>
                            0123 456 789</p>

                            <p><strong>Email:</strong><br>
                            info@petfoodshop.com</p>

                            <p><strong>Giờ làm việc:</strong><br>
                            Thứ 2 - Thứ 7: 8:00 - 20:00<br>
                            Chủ nhật: 9:00 - 18:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
