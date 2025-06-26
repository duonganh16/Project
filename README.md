# 🚀 PetFood Shop - Laravel Web Application

**Họ tên sinh viên**: Nguyễn Dương Ngọc Ánh
**Mã sinh viên**: 23011500

---

## 📝 Giới thiệu Project

**PetFood Shop** là một ứng dụng web bán hàng thức ăn thú cưng, phát triển bằng Laravel, có các chức năng:
- Quản lý sản phẩm
- Phân loại sản phẩm theo danh mục
- Đặt hàng trực tuyến
- Xác thực người dùng (Laravel Breeze)
- Lưu trữ dữ liệu trên Cloud (Aiven)

---
## Mục tiêu
- Tạo một website thương mại điện tử đơn giản dùng Laravel.
- Làm quen với các khái niệm như: route, controller, model, migration, seeder, middleware.
- Thực hành thao tác giỏ hàng, xử lý đơn hàng, xác thực người dùng.
- Làm quen với template Blade và Bootstrap để thiết kế giao diện người dùng.

---

## 🧩 Công nghệ sử dụng

- Laravel 10+
- Laravel Breeze (Xác thực)
- MySQL (trên Aiven Cloud)
- Bootstrap (Giao diện)
- Storage cho ảnh sản phẩm

---
## Cấu trúc thư mục chính
petfood-shop/
├── app/
├── resources/
│   └── views/
├── routes/
├── public/
├── database/
└── composer.json
---

## 📦 Các đối tượng chính (3+)

- `User`: người dùng đăng nhập
- 'Admin' : người quản lý sản phẩm
- `Product`: sản phẩm thú cưng
- `Category`: danh mục sản phẩm
- `Order`: đơn đặt hàng
- `OrderItem`: chi tiết từng sản phẩm trong đơn

---

## 🧱 Sơ đồ cấu trúc (Class Diagram)

![Image](https://github.com/user-attachments/assets/47044b1e-afb0-4c46-8bc0-d0682254e8d9)

Quan hệ giữa các đối tượng được biểu diễn rõ ràng:
- 1 `User` có nhiều `Order`
- 1 `Category` có nhiều `Product`
- 1 `Order` có nhiều `OrderItem`

---

## 🔁 Sơ đồ thuật toán (Activity Diagram)

### 1. Activity Diagram: Đặt hàng sản phẩm

![Image](https://github.com/user-attachments/assets/46e8a701-e675-47de-a349-db8152a6f1d0)

### 2. Activity Diagram: Hiển thị sản phẩm theo danh mục

![Image](https://github.com/user-attachments/assets/41f10b41-3009-4457-b124-40aa7114932c)

---

## 🖼 Ảnh chụp màn hình

### ✅ Trang chủ

![Image](https://github.com/user-attachments/assets/2cc768e1-429a-477c-b057-7e1c41850a28)

### ✅ Trang đăng ký / đăng nhập

![Image](https://github.com/user-attachments/assets/5544ad8a-73ca-40e4-adbb-003de3603376)

### ✅ Giao diện đặt hàng

![Image](https://github.com/user-attachments/assets/67c41c9c-d983-46b3-a41e-db865a80b21b)

### ✅ Quản lý sản phẩm

![Image](https://github.com/user-attachments/assets/0fb5dc4d-d87c-49a6-9d41-6bd7da2d6326)

---
## Hướng dẫn cài đặt

- git clone https://github.com/duonganh16/petfood-shop.git
 cd petfood-shop
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate --seed
- php artisan serve
---
## Dữ liệu mẫu (Seeder)
- Admin: admin@example.com / password
- User: user@example.com / password
---
## Bảo mật và xác thực
- Laravel Breeze cho login/register/logout
- Middleware kiểm tra phân quyền
- CSRF token cho form
- Flash message
---
## Các tệp quan trọng
- web.php
- ProductController.php
- CartController.php
- OrderController.php
- AdminController.php
- ContactController.php
---
## Sơ đồ kiến trúc hệ thống
- [Trình duyệt] -> [Laravel Router] -> [Controller] -> [Model] -> [Database]
---
## Quy trình hoạt động
- Đặt hàng: Xem -> Giỏ -> Thanh toán
- Admin: Đăng nhập -> Xử lý đơn hàng
---
## Mô tả chức năng chi tiết
- Đăng ký / Đăng nhập
- Xem sản phẩm
- Thêm giỏ hàng
- Đặt hàng
- Admin dashboard
---
## Thống kê	
- Tổng số người dùng, doanh thu, đơn hàng
---
## Hướng dẫn bảo trì
- composer update
- mysqldump
- xem log
- clear cache
---
## 💡 Code minh hoạ

### ✨ `Product` Model

```php
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'image', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
}
OrderController - Đặt hàng
php
Sao chép mã
public function placeOrder(Request $request)
{
    $order = Order::create([
        'user_id' => Auth::id(),
        'total_price' => $request->total,
        'status' => 'pending',
    ]);

    foreach ($request->items as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    return redirect()->route('orders.index')->with('success', 'Đặt hàng thành công!');
}
🌍 Liên kết dự án
🔗 Link Repo GitHub: https://github.com/duonganh16/Project

🌐 Link Demo Codespace (public): 

☁️ CSDL Aiven Cloud: MySQL hosted

🔒 Bảo mật đã áp dụng
✅ CSRF Token (mặc định Laravel)

✅ Validation đầu vào (Form Request)

✅ Xác thực và phân quyền (Breeze + Middleware)

✅ Session / Cookie được mã hóa

✅ Tránh SQL Injection (Eloquent ORM)

✅ Escape XSS trong Blade: {{ $data }}


---

## 🔒 Tính năng Bảo mật đã triển khai

### ✅ Authentication & Authorization
- **Laravel Breeze**: Hệ thống đăng nhập/đăng ký hoàn chỉnh
- **Admin Middleware**: Phân quyền admin với `is_admin` flag
- **Policy Authorization**: ProductPolicy kiểm soát quyền truy cập CRUD
- **Session Security**: Cấu hình session bảo mật với encryption

### ✅ CSRF Protection
- **CSRF Token**: Tất cả form đều có `@csrf` protection
- **Middleware**: VerifyCsrfToken middleware được kích hoạt
- **AJAX Protection**: Token được embed trong meta tag

### ✅ XSS Protection
- **Input Sanitization**: XssProtection middleware loại bỏ HTML tags
- **Output Escaping**: Blade template engine tự động escape `{{ }}`
- **Custom Helper**: SecurityHelper::escape() cho output manual

### ✅ Data Validation
- **Form Request**: ProductRequest với validation rules chi tiết
- **File Upload**: Validate MIME type, size, dimensions cho hình ảnh
- **Input Cleaning**: Strip tags và sanitize input data
- **Regex Validation**: Kiểm tra format tên sản phẩm

### ✅ Rate Limiting
- **Admin Routes**: Giới hạn 30 requests/phút cho admin panel
- **IP-based**: Rate limiting theo IP address
- **Middleware**: RateLimitMiddleware tùy chỉnh

### ✅ Database Security
- **Eloquent ORM**: Tránh SQL Injection tự động
- **Prepared Statements**: Laravel sử dụng PDO prepared statements
- **Soft Deletes**: Bảo vệ dữ liệu với soft delete thay vì hard delete

---

## 🌐 Cloud Deployment

### 🚀 Chuẩn bị Deploy
- **Environment**: File `.env.production` cho production
- **Docker**: Dockerfile và docker-compose.yml
- **Deploy Script**: `deploy.sh` tự động hóa deployment
- **Apache Config**: Cấu hình Apache cho production

### 📋 Hướng dẫn Deploy lên Cloud

#### Railway Platform
```bash
# 1. Cài đặt Railway CLI
npm install -g @railway/cli

# 2. Login và khởi tạo project
railway login
railway init

# 3. Deploy
railway up
```

#### Manual Server
```bash
# 1. Upload code lên server
# 2. Chạy script deployment
chmod +x deploy.sh
./deploy.sh
```

### 🔧 Production Configuration
- **APP_ENV**: production
- **APP_DEBUG**: false
- **HTTPS**: SSL certificate required
- **Database**: MySQL trên cloud (Aiven/PlanetScale)
- **Storage**: Public disk với symbolic link

---

## 👥 Tài khoản Test

### Admin Account
- **Email**: admin@petfood.com
- **Password**: admin123
- **Quyền**: Quản lý sản phẩm, xem orders

### Customer Account
- **Email**: test@example.com
- **Password**: password
- **Quyền**: Mua hàng, xem lịch sử đơn hàng

---

📞 **Liên hệ**
**Sinh viên**: Nguyễn Dương Ngọc Ánh
**Mã SV**: 23011500
**Email**: 23011500@st.phenikaa-uni.edu.vn
