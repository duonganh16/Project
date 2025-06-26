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

## 🧩 Công nghệ sử dụng

- Laravel 10+
- Laravel Breeze (Xác thực)
- MySQL (trên Aiven Cloud)
- Bootstrap (Giao diện)
- Storage cho ảnh sản phẩm

---

## 📦 Các đối tượng chính (3+)

- `User`: người dùng đăng nhập
- `Product`: sản phẩm thú cưng
- `Category`: danh mục sản phẩm
- `Order`: đơn đặt hàng
- `OrderItem`: chi tiết từng sản phẩm trong đơn

---

## 🧱 Sơ đồ cấu trúc (Class Diagram)

![Class Diagram](images/class-diagram.png)

*Giải thích:*  
Quan hệ giữa các đối tượng được biểu diễn rõ ràng:
- 1 `User` có nhiều `Order`
- 1 `Category` có nhiều `Product`
- 1 `Order` có nhiều `OrderItem`

---

## 🔁 Sơ đồ thuật toán (Activity Diagram)

### 1. Activity Diagram: Đặt hàng sản phẩm

![Activity Diagram](images/activity-order.png)

### 2. Activity Diagram: Hiển thị sản phẩm theo danh mục

![Activity Diagram](images/activity-filter-category.png)

---

## 🖼 Ảnh chụp màn hình

### ✅ Trang chủ

![Trang chủ](images/homepage.png)

### ✅ Trang đăng ký / đăng nhập

![Đăng nhập](images/login.png)

### ✅ Giao diện đặt hàng

![Đặt hàng](images/order.png)

### ✅ Quản lý sản phẩm

![Quản lý sản phẩm](images/admin-product.png)

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
🔗 Link Repo GitHub: https://github.com/username/petfood-shop

🌐 Link Demo Codespace (public): https://petfood-shop-yourname.github.dev

☁️ CSDL Aiven Cloud: MySQL hosted

🔒 Bảo mật đã áp dụng
✅ CSRF Token (mặc định Laravel)

✅ Validation đầu vào (Form Request)

✅ Xác thực và phân quyền (Breeze + Middleware)

✅ Session / Cookie được mã hóa

✅ Tránh SQL Injection (Eloquent ORM)

✅ Escape XSS trong Blade: {{ $data }}


---

## � Tính năng Bảo mật đã triển khai

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

📞 Liên hệ
**Sinh viên**: Nguyễn Dương Ngọc Ánh
**Mã SV**: 23011500
**Email**: nguyenduongngoanh@student.ptit.edu.vn
