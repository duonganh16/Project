@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liên hệ</h2>
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
            <textarea name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</div>
@endsection
