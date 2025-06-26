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

![Activity Diagram](activity-order.png)

### 2. Activity Diagram: Hiển thị sản phẩm theo danh mục

![Activity Diagram](activity-filter-category.png)

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
🔗 Link Repo GitHub: 

🌐 Link Demo Codespace (public): 

☁️ CSDL Aiven Cloud: MySQL hosted

🔒 Bảo mật đã áp dụng
✅ CSRF Token (mặc định Laravel)

✅ Validation đầu vào (Form Request)

✅ Xác thực và phân quyền (Breeze + Middleware)

✅ Session / Cookie được mã hóa

✅ Tránh SQL Injection (Eloquent ORM)

✅ Escape XSS trong Blade: {{ $data }}



