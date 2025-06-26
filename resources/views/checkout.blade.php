@extends('layouts.petfood')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2 class="mb-4">Thanh toán đơn hàng</h2>

            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/place-order" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5>Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', auth()->user()->name ?? '') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                            <textarea name="address"
                                      class="form-control @error('address') is-invalid @enderror"
                                      rows="3"
                                      required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="tel"
                                   name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}"
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Ghi chú (tùy chọn)</label>
                            <textarea name="note"
                                      class="form-control @error('note') is-invalid @enderror"
                                      rows="3">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-shopping-cart"></i> Đặt hàng
                    </button>
                    <a href="/cart" class="btn btn-secondary btn-lg ms-2">
                        <i class="fas fa-arrow-left"></i> Quay lại giỏ hàng
                    </a>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Tóm tắt đơn hàng</h5>
                </div>
                <div class="card-body">
                    @php
                        $total = 0;
                    @endphp

                    @foreach($cart as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <strong>{{ $item['product']->name }}</strong><br>
                                <small class="text-muted">{{ $item['quantity'] }} x {{ number_format($item['price']) }} VNĐ</small>
                            </div>
                            <div class="text-end">
                                {{ number_format($item['price'] * $item['quantity']) }} VNĐ
                            </div>
                        </div>
                        @php
                            $total += $item['price'] * $item['quantity'];
                        @endphp
                    @endforeach

                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Tổng cộng:</strong>
                        <strong class="text-success">{{ number_format($total) }} VNĐ</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection