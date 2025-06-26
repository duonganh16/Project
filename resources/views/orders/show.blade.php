@extends('layouts.petfood')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>

            <div class="row">
                {{-- Order Information --}}
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Thông tin đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
                                    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong>Trạng thái:</strong> 
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'processing' => 'info',
                                                'shipped' => 'primary',
                                                'delivered' => 'success',
                                                'cancelled' => 'danger'
                                            ];
                                            $statusLabels = [
                                                'pending' => 'Chờ xử lý',
                                                'processing' => 'Đang xử lý',
                                                'shipped' => 'Đã gửi hàng',
                                                'delivered' => 'Đã giao hàng',
                                                'cancelled' => 'Đã hủy'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                            {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Tổng tiền:</strong> 
                                        <span class="h5 text-success">{{ number_format($order->total_amount) }} VNĐ</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Shipping Information --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Thông tin giao hàng</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Người nhận:</strong> {{ $order->name }}</p>
                            <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                            <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                            @if($order->note)
                                <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Order Items --}}
                    <div class="card">
                        <div class="card-header">
                            <h5>Sản phẩm đã đặt</h5>
                        </div>
                        <div class="card-body">
                            @foreach($order->items as $item)
                                <div class="row align-items-center mb-3 pb-3 border-bottom">
                                    <div class="col-md-2">
                                        @if($item->product && $item->product->image)
                                            @if(filter_var($item->product->image, FILTER_VALIDATE_URL))
                                                <img src="{{ $item->product->image }}"
                                                     alt="{{ $item->product->name }}"
                                                     class="img-fluid rounded"
                                                     style="max-height: 80px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                     alt="{{ $item->product->name }}"
                                                     class="img-fluid rounded"
                                                     style="max-height: 80px; object-fit: cover;">
                                            @endif
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="height: 80px;">
                                                <span class="text-muted">No Image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-5">
                                        <h6>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</h6>
                                        @if($item->product && $item->product->description)
                                            <small class="text-muted">
                                                {{ Str::limit($item->product->description, 100) }}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <span class="badge bg-secondary">x{{ $item->quantity }}</span>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <strong>{{ number_format($item->price) }} VNĐ</strong>
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <strong class="text-success">
                                            {{ number_format($item->price * $item->quantity) }} VNĐ
                                        </strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tóm tắt đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $subtotal = $order->items->sum(function($item) {
                                    return $item->price * $item->quantity;
                                });
                            @endphp
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <span>{{ number_format($subtotal) }} VNĐ</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span>Phí vận chuyển:</span>
                                <span class="text-success">Miễn phí</span>
                            </div>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between">
                                <strong>Tổng cộng:</strong>
                                <strong class="text-success">{{ number_format($order->total_amount) }} VNĐ</strong>
                            </div>
                            
                            <div class="mt-4">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Đơn hàng được đặt vào {{ $order->created_at->format('d/m/Y \l\ú\c H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Order Status Timeline --}}
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6>Trạng thái đơn hàng</h6>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item {{ $order->status == 'pending' ? 'active' : 'completed' }}">
                                    <i class="fas fa-clock"></i>
                                    <span>Chờ xử lý</span>
                                </div>
                                <div class="timeline-item {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'completed' : '' }} {{ $order->status == 'processing' ? 'active' : '' }}">
                                    <i class="fas fa-cog"></i>
                                    <span>Đang xử lý</span>
                                </div>
                                <div class="timeline-item {{ in_array($order->status, ['shipped', 'delivered']) ? 'completed' : '' }} {{ $order->status == 'shipped' ? 'active' : '' }}">
                                    <i class="fas fa-truck"></i>
                                    <span>Đã gửi hàng</span>
                                </div>
                                <div class="timeline-item {{ $order->status == 'delivered' ? 'completed active' : '' }}">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Đã giao hàng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    padding-bottom: 20px;
    color: #6c757d;
}

.timeline-item:before {
    content: '';
    position: absolute;
    left: -22px;
    top: 8px;
    width: 2px;
    height: 100%;
    background-color: #dee2e6;
}

.timeline-item:last-child:before {
    display: none;
}

.timeline-item i {
    position: absolute;
    left: -30px;
    top: 0;
    width: 16px;
    height: 16px;
    background-color: #fff;
    border: 2px solid #dee2e6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 8px;
}

.timeline-item.completed i {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
}

.timeline-item.active i {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

.timeline-item.completed {
    color: #28a745;
}

.timeline-item.active {
    color: #007bff;
    font-weight: bold;
}
</style>
@endsection
