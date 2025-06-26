@extends('layouts.petfood')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Chỉnh sửa sản phẩm: {{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $product->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Giá (VNĐ) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price', $product->price) }}" 
                                   min="0" 
                                   step="1000" 
                                   required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>

                            @if($product->image)
                                <div class="mb-2">
                                    @if(filter_var($product->image, FILTER_VALIDATE_URL))
                                        <img src="{{ $product->image }}"
                                             alt="{{ $product->name }}"
                                             class="img-thumbnail"
                                             style="max-width: 200px;">
                                    @else
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="img-thumbnail"
                                             style="max-width: 200px;">
                                    @endif
                                    <p class="text-muted small">Hình ảnh hiện tại</p>
                                </div>
                            @endif

                            {{-- Tab Navigation --}}
                            <ul class="nav nav-tabs" id="imageTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="upload-tab" data-bs-toggle="tab"
                                            data-bs-target="#upload" type="button" role="tab">
                                        Upload File
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="url-tab" data-bs-toggle="tab"
                                            data-bs-target="#url" type="button" role="tab">
                                        URL Hình ảnh
                                    </button>
                                </li>
                            </ul>

                            {{-- Tab Content --}}
                            <div class="tab-content" id="imageTabContent">
                                <div class="tab-pane fade show active" id="upload" role="tabpanel">
                                    <div class="mt-3">
                                        <input type="file"
                                               class="form-control @error('image') is-invalid @enderror"
                                               id="image"
                                               name="image"
                                               accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Chấp nhận: JPEG, PNG, JPG, GIF, WebP. Tối đa 2MB. Để trống nếu không muốn thay đổi.</div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="url" role="tabpanel">
                                    <div class="mt-3">
                                        <input type="url"
                                               class="form-control @error('image_url') is-invalid @enderror"
                                               id="image_url"
                                               name="image_url"
                                               value="{{ old('image_url') }}"
                                               placeholder="https://example.com/image.jpg">
                                        @error('image_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Nhập URL hình ảnh (jpg, jpeg, png, gif, webp). Để trống nếu không muốn thay đổi.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cập nhật sản phẩm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Font Awesome for icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
