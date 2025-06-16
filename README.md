# 🐾 PetFood Shop

Website bán đồ ăn thú cưng được xây dựng bằng Laravel.

## 📝 Mô tả

**PetFood Shop** là một website thương mại điện tử đơn giản cho phép người dùng duyệt, xem chi tiết sản phẩm, thêm vào giỏ hàng và tiến hành đặt hàng. Dự án mô phỏng quy trình bán hàng online cho thú cưng, hướng đến việc học Laravel, Blade template, xử lý giỏ hàng và seeding dữ liệu cơ bản.

Phù hợp cho sinh viên, người học web backend và frontend cơ bản với Laravel framework.


## 🚀 Tính năng chính

- Hiển thị danh sách và chi tiết sản phẩm
- Giỏ hàng và thanh toán đơn giản
- Trang giới thiệu, liên hệ
- Seeder tự động tạo dữ liệu mẫu

## 🧱 Công nghệ

- Laravel 10.x
- Blade Template
- Bootstrap 5
- MySQL hoặc SQLite

## ⚙️ Cài đặt

```bash
git clone: https://github.com/duonganh16/petfood-shop.git
cd petfood-shop
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
