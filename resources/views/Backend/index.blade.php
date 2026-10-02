<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý sản phẩm</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: #f0f2f5;
      padding: 24px;
      color: #333;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,.08);
      overflow: hidden;
    }
    /* Admin Menu Bar */
    .admin-menu {
      background: #1f2937;
      color: #fff;
      padding: 14px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .admin-menu .logo {
      font-weight: 600;
      font-size: 16px;
    }
    .admin-menu nav {
      display: flex;
      gap: 20px;
      align-items: center;
    }
    .admin-menu nav a {
      color: #d1d5db;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: color .15s;
    }
    .admin-menu nav a:hover, .admin-menu nav a.active {
      color: #ef4444;
    }

    .header-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 24px;
      border-bottom: 1px solid #e5e7eb;
      background: #f8f9fa;
    }
    .header-bar h1 {
      font-size: 20px;
      font-weight: 600;
      color: #111827;
    }
    .actions {
      display: flex;
      gap: 12px;
    }
    .btn {
      padding: 9px 16px;
      font-size: 14px;
      font-weight: 500;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all .15s;
    }
    .btn-primary {
      background: #ef4444;
      color: #fff;
    }
    .btn-primary:hover { background: #dc2626; }
    .btn-secondary {
      background: #fff;
      border: 1px solid #d1d5db;
      color: #374151;
    }
    .btn-secondary:hover { background: #f9fafb; }
    .btn-danger {
      background: #fee2e2;
      color: #dc2626;
    }
    .btn-danger:hover { background: #fecaca; }
    .btn-sm {
      padding: 6px 10px;
      font-size: 12px;
    }
    
    .content-body {
      padding: 24px;
    }
    .alert {
      padding: 12px 16px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }
    .alert-success {
      background: #ecfdf5;
      color: #065f46;
      border: 1px solid #a7f3d0;
    }

    .search-box {
      margin-bottom: 20px;
      display: flex;
      gap: 12px;
    }
    .search-box input {
      flex: 1;
      padding: 9px 12px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
    }
    .search-box input:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59,130,246,.15);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }
    th, td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
    }
    th {
      background: #f9fafb;
      font-weight: 600;
      color: #374151;
    }
    tr:hover { background: #fdfdfd; }
    .product-img {
      width: 48px;
      height: 48px;
      object-fit: cover;
      border-radius: 4px;
      border: 1px solid #e5e7eb;
    }
    .product-name {
      font-weight: 500;
      color: #111827;
    }
    .product-code {
      font-size: 12px;
      color: #6b7280;
    }
    .price {
      font-weight: 600;
      color: #ef4444;
    }
    .badge {
      display: inline-block;
      padding: 4px 8px;
      font-size: 12px;
      font-weight: 500;
      border-radius: 9999px;
      background: #e5e7eb;
      color: #374151;
    }
    .actions-cell {
      display: flex;
      gap: 8px;
    }
    .empty-state {
      text-align: center;
      padding: 40px;
      color: #6b7280;
    }

    /* Pagination styling */
    .pagination-container {
      margin-top: 24px;
      display: flex;
      justify-content: center;
    }
    .pagination {
      display: flex;
      list-style: none;
      gap: 4px;
      padding: 0;
    }
    .pagination li a, .pagination li span {
      padding: 8px 12px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      text-decoration: none;
      color: #374151;
      font-size: 14px;
      display: inline-block;
      background: #fff;
    }
    .pagination li.active span {
      background: #ef4444;
      color: #fff;
      border-color: #ef4444;
    }
    .pagination li.disabled span {
      color: #9ca3af;
      background: #f9fafb;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="admin-menu">
      <div class="logo">Admin Dashboard</div>
      <nav>
        <a href="/backend/products" class="active">📦 Quản lý sản phẩm</a>
        <a href="/backend/categories">📁 Quản lý danh mục</a>
        <a href="/backend/product/create">+ Thêm sản phẩm</a>
        <a href="/backend/category/create">+ Thêm danh mục</a>
        <a href="/" style="color: #9ca3af; font-size: 13px;">🌐 Xem Website</a>
      </nav>
    </div>

    <div class="header-bar">
      <h1>Danh sách sản phẩm (products.json)</h1>
      <div class="actions">
        <a href="/backend/product/create" class="btn btn-primary">+ Thêm sản phẩm</a>
      </div>
    </div>

    <div class="content-body">
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Tìm kiếm sản phẩm theo tên, model..." onkeyup="filterTable()">
      </div>

      <div style="overflow-x: auto;">
        <table id="productTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Ảnh</th>
              <th>Tên sản phẩm</th>
              <th>Model / Mã</th>
              <th>Giá</th>
              <th>Kho</th>
              <th>Hãng</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @forelse($products as $product)
              <tr>
                <td>{{ $product['id'] ?? '' }}</td>
                <td>
                  @php
                    $img = !empty($product['images'][0]) ? $product['images'][0] : 'https://via.placeholder.com/480x360/333/fff?text=No+Image';
                  @endphp
                  <img src="{{ $img }}" alt="{{ $product['name'] ?? '' }}" class="product-img">
                </td>
                <td>
                  <div class="product-name">{{ $product['name'] ?? 'Chưa có tên' }}</div>
                  <div class="product-code">Slug: {{ $product['slug'] ?? '' }}</div>
                </td>
                <td>{{ $product['code'] ?? ($product['model'] ?? '-') }}</td>
                <td class="price">
                  {{ number_format($product['price'] ?? 0, 0, ',', '.') }} đ
                </td>
                <td>
                  <span class="badge">{{ $product['quantity'] ?? ($product['stock'] ?? 0) }}</span>
                </td>
                <td>{{ $product['brand'] ?? ($product['category'] ?? '-') }}</td>
                <td>
                  <div class="actions-cell">
                    <a href="/backend/product/{{ $product['id'] }}/edit" class="btn btn-secondary btn-sm">Sửa</a>
                    <form action="/backend/product/{{ $product['id'] }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="empty-state">Không có sản phẩm nào trong products.json</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="pagination-container">
        {{ $products->links() }}
      </div>
    </div>
  </div>

  <script>
    function filterTable() {
      const input = document.getElementById('searchInput');
      const filter = input.value.toLowerCase();
      const table = document.getElementById('productTable');
      const tr = table.getElementsByTagName('tr');

      for (let i = 1; i < tr.length; i++) {
        let tdName = tr[i].getElementsByTagName('td')[2];
        let tdCode = tr[i].getElementsByTagName('td')[3];
        if (tdName || tdCode) {
          let textName = tdName ? tdName.textContent || tdName.innerText : '';
          let textCode = tdCode ? tdCode.textContent || tdCode.innerText : '';
          if (textName.toLowerCase().indexOf(filter) > -1 || textCode.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>
</body>
</html>
