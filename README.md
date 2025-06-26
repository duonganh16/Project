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

![Trang chủ](![z6742738895701_22536046c5e2bccb622adf1e76d7201e.png])

### ✅ Trang đăng ký / đăng nhập

![Đăng nhập](![z6742738905366_b971cab65abf1a8130eaad88c81dec2a.png])

### ✅ Giao diện đặt hàng

![Đặt hàng](![z6742738892332_3799086cd15c479e8286f4657027d7ad.png])

### ✅ Quản lý sản phẩm

![Quản lý sản phẩm](![z6742738904938_d573e532d8861741bc49c7d4717b048e.png])

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



