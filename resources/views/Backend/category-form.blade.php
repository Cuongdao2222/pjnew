<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm danh mục mới</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: #f0f2f5;
      padding: 24px;
      color: #333;
    }
    .form-container {
      max-width: 700px;
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

    .top-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 24px;
      background: #f8f9fa;
      border-bottom: 1px solid #e5e7eb;
    }
    .top-nav h2 {
      font-size: 18px;
      font-weight: 600;
      color: #111827;
    }
    .top-nav a {
      font-size: 14px;
      color: #3b82f6;
      text-decoration: none;
      font-weight: 500;
    }
    .top-nav a:hover { text-decoration: underline; }

    .form-body {
      padding: 24px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    label {
      font-size: 13px;
      font-weight: 600;
      color: #374151;
    }
    input[type="text"], select {
      padding: 9px 12px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
    }
    input:focus, select:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59,130,246,.15);
    }
    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      padding: 16px 24px;
      border-top: 1px solid #e5e7eb;
      background: #fafafa;
    }
    .btn {
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 500;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: all .15s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
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
  </style>
</head>
<body>
  @php
    $selectedParentId = request('parent_id');
  @endphp

  <div class="form-container">
    <div class="admin-menu">
      <div class="logo">Admin Dashboard</div>
      <nav>
        <a href="/backend/products">📦 Quản lý sản phẩm</a>
        <a href="/backend/categories">📁 Quản lý danh mục</a>
        <a href="/backend/product/create">+ Thêm sản phẩm</a>
        <a href="/backend/category/create" class="active">+ Thêm danh mục</a>
        <a href="/" style="color: #9ca3af; font-size: 13px;">🌐 Xem Website</a>
      </nav>
    </div>

    <div class="top-nav">
      <h2>Thêm danh mục / danh mục con</h2>
      <a href="/backend/categories">← Quay lại danh sách danh mục</a>
    </div>

    <form action="/backend/category/store" method="POST">
      @csrf
      <div class="form-body">
        <div class="form-group">
          <label for="parent_id">Danh mục cha (Tùy chọn tạo đệ quy danh mục con):</label>
          <select id="parent_id" name="parent_id">
            <option value="">-- Danh mục gốc (Parent) --</option>
            @php
              $renderCategoryOptions = function($cats, $selectedId, $prefix = '') use (&$renderCategoryOptions) {
                foreach ($cats as $cat) {
                  $id = $cat['id'] ?? '';
                  $name = $cat['tên'] ?? ($cat['name'] ?? '');
                  $sel = ($selectedId == $id) ? 'selected' : '';
                  echo '<option value="' . $id . '" ' . $sel . '>' . $prefix . $name . '</option>';
                  if (!empty($cat['subcategories'])) {
                    $renderCategoryOptions($cat['subcategories'], $selectedId, $prefix . '-- ');
                  }
                }
              };
            @endphp
            @if(isset($categories))
              @php $renderCategoryOptions($categories, $selectedParentId); @endphp
            @endif
          </select>
        </div>

        <div class="form-group">
          <label for="tên">Tên danh mục: <span style="color:#ef4444">*</span></label>
          <input type="text" id="tên" name="tên" placeholder="Nhập tên danh mục" required>
        </div>

        <div class="form-group">
          <label for="slug">Slug (Đường dẫn):</label>
          <input type="text" id="slug" name="slug" placeholder="tu-dong-tao-neu-de-trong">
        </div>

        <div class="form-group">
          <label for="đường dẫn ảnh">Đường dẫn ảnh (Image URL):</label>
          <input type="text" id="đường dẫn ảnh" name="đường dẫn ảnh" placeholder="https://...">
        </div>
      </div>

      <div class="form-actions">
        <a href="/backend/categories" class="btn btn-secondary">Hủy</a>
        <button type="submit" class="btn btn-primary">Lưu danh mục</button>
      </div>
    </form>
  </div>

  <script>
    const nameInput = document.getElementById('tên');
    const slugInput = document.getElementById('slug');

    function slugify(str) {
      return str.toLowerCase()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
        .replace(/đ/g, 'd').replace(/Đ/g, 'D')
        .replace(/[^a-z0-9\s-]/g, '')
        .trim().replace(/\s+/g, '-').replace(/-+/g, '-');
    }

    nameInput.addEventListener('input', () => {
      slugInput.value = slugify(nameInput.value);
    });
  </script>
</body>
</html>
