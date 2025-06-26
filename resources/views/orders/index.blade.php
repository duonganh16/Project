@extends('layouts.petfood')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Đơn hàng của tôi</h2>
                <a href="/" class="btn btn-outline-primary">
                    <i class="fas fa-shopping-bag"></i> Tiếp tục mua sắm
                </a>
            </div>

            @if($orders->count() > 0)
                <div class="row">
                    @foreach($orders as $order)
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <strong>Đơn hàng #{{ $order->id }}</strong>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted">
                                                {{ $order->created_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                        <div class="col-md-3">
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
                                        </div>
                                        <div class="col-md-3 text-end">
                                            <strong class="text-success">
                                                {{ number_format($order->total_amount) }} VNĐ
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6>Thông tin giao hàng:</h6>
                                            <p class="mb-1"><strong>Người nhận:</strong> {{ $order->name }}</p>
                                            <p class="mb-1"><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                                            <p class="mb-1"><strong>Điện thoại:</strong> {{ $order->phone }}</p>
                                            @if($order->note)
                                                <p class="mb-1"><strong>Ghi chú:</strong> {{ $order->note }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <h6>Sản phẩm ({{ $order->items->count() }} món):</h6>
                                            @foreach($order->items->take(3) as $item)
                                                <div class="d-flex align-items-center mb-2">
                                                    @if($item->product && $item->product->image)
                                                        @if(filter_var($item->product->image, FILTER_VALIDATE_URL))
                                                            <img src="{{ $item->product->image }}"
                                                                 alt="{{ $item->product->name }}"
                                                                 class="me-2"
                                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                                        @else
                                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                                 alt="{{ $item->product->name }}"
                                                                 class="me-2"
                                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                                        @endif
                                                    @endif
                                                    <div>
                                                        <small>
                                                            {{ $item->product->name ?? 'Sản phẩm đã xóa' }} 
                                                            (x{{ $item->quantity }})
                                                        </small>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if($order->items->count() > 3)
                                                <small class="text-muted">
                                                    và {{ $order->items->count() - 3 }} sản phẩm khác...
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="text-end mt-3">
                                        <a href="{{ route('orders.show', $order->id) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i> Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($orders->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-shopping-cart fa-5x text-muted"></i>
                    </div>
                    <h4>Bạn chưa có đơn hàng nào</h4>
                    <p class="text-muted">Hãy khám phá các sản phẩm tuyệt vời của chúng tôi!</p>
                    <a href="/" class="btn btn-primary">
                        <i class="fas fa-shopping-bag"></i> Bắt đầu mua sắm
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
