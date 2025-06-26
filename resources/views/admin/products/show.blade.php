@extends('layouts.petfood')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Chi tiết sản phẩm</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-fluid rounded">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                     style="height: 200px;">
                                    <span class="text-muted">Không có hình ảnh</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $product->name }}</h3>
                            
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">ID:</th>
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <th>Giá:</th>
                                    <td><strong class="text-success">{{ number_format($product->price) }} VNĐ</strong></td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo:</th>
                                    <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Cập nhật lần cuối:</th>
                                    <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                            
                            @if($product->description)
                                <div class="mt-3">
                                    <h5>Mô tả:</h5>
                                    <p class="text-muted">{{ $product->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại danh sách
                        </a>
                        <div>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Chỉnh sửa
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Font Awesome for icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
