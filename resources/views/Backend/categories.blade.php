<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý danh mục (Categories)</title>
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

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }
    th, td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
      vertical-align: top;
    }
    th {
      background: #f9fafb;
      font-weight: 600;
      color: #374151;
    }
    tr:hover { background: #fdfdfd; }
    .cat-img {
      width: 48px;
      height: 48px;
      object-fit: cover;
      border-radius: 4px;
      border: 1px solid #e5e7eb;
    }
    .cat-name {
      font-weight: 600;
      color: #111827;
      font-size: 15px;
    }
    .cat-slug {
      font-size: 12px;
      color: #6b7280;
    }
    .sub-list {
      margin-top: 8px;
      padding-left: 16px;
      border-left: 2px solid #e5e7eb;
    }
    .sub-item {
      margin-bottom: 6px;
      font-size: 13px;
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
  </style>
</head>
<body>
  <div class="container">
    <div class="admin-menu">
      <div class="logo">Admin Dashboard</div>
      <nav>
        <a href="/backend/products">📦 Quản lý sản phẩm</a>
        <a href="/backend/categories" class="active">📁 Quản lý danh mục</a>
        <a href="/backend/product/create">+ Thêm sản phẩm</a>
        <a href="/backend/category/create">+ Thêm danh mục</a>
        <a href="/" style="color: #9ca3af; font-size: 13px;">🌐 Xem Website</a>
      </nav>
    </div>

    <div class="header-bar">
      <h1>Quản lý danh mục (categories.json) - Đệ quy đa cấp</h1>
      <div class="actions">
        <a href="/backend/category/create" class="btn btn-primary">+ Thêm danh mục</a>
      </div>
    </div>

    <div class="content-body">
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <div style="overflow-x: auto;">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Ảnh</th>
              <th>Tên danh mục (Cha & Con đệ quy)</th>
              <th>Slug</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @forelse($categories as $category)
              <tr>
                <td>{{ $category['id'] ?? '' }}</td>
                <td>
                  @php
                    $img = !empty($category['đường dẫn ảnh']) ? $category['đường dẫn ảnh'] : (!empty($category['image']) ? $category['image'] : 'https://via.placeholder.com/300x300?text=Category');
                  @endphp
                  <img src="{{ $img }}" alt="{{ $category['tên'] ?? '' }}" class="cat-img">
                </td>
                <td>
                  <div class="cat-name">{{ $category['tên'] ?? ($category['name'] ?? 'Chưa có tên') }}</div>
                  
                  @php
                    $renderRecursiveSubs = function($subs) use (&$renderRecursiveSubs) {
                      if (empty($subs)) return;
                      echo '<div class="sub-list">';
                      foreach ($subs as $sub) {
                          $subName = $sub['tên'] ?? ($sub['name'] ?? '');
                          $subSlug = $sub['slug'] ?? '';
                          echo '<div class="sub-item">';
                          echo '• <strong>' . htmlspecialchars($subName) . '</strong> <span class="cat-slug">(' . htmlspecialchars($subSlug) . ')</span>';
                          if (!empty($sub['subcategories'])) {
                              $renderRecursiveSubs($sub['subcategories']);
                          }
                          echo '</div>';
                      }
                      echo '</div>';
                    };
                  @endphp

                  @if(!empty($category['subcategories']))
                    @php $renderRecursiveSubs($category['subcategories']); @endphp
                  @else
                    <div style="font-size: 12px; color: #9ca3af; margin-top: 4px;">Không có danh mục con</div>
                  @endif
                </td>
                <td>
                  <span class="cat-slug">{{ $category['slug'] ?? '' }}</span>
                </td>
                <td>
                  <div class="actions-cell">
                    <a href="/backend/category/create?parent_id={{ $category['id'] }}" class="btn btn-secondary btn-sm">+ Thêm danh mục con</a>
                    <form action="/backend/category/{{ $category['id'] }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="empty-state">Không có danh mục nào trong categories.json</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
