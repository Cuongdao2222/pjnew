<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ isset($product) ? 'Sửa sản phẩm' : 'Thêm sản phẩm mới' }}</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: #f0f2f5;
      padding: 24px;
      color: #333;
    }
    .form-container {
      max-width: 1100px;
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

    /* Tabs */
    .tabs {
      display: flex;
      background: #f8f9fa;
      border-bottom: 1px solid #e5e7eb;
      overflow-x: auto;
    }
    .tab {
      padding: 12px 18px;
      font-size: 14px;
      font-weight: 500;
      color: #374151;
      background: #f3f4f6;
      border: none;
      border-right: 1px solid #e5e7eb;
      cursor: pointer;
      white-space: nowrap;
      transition: all .15s;
    }
    .tab:hover { background: #e5e7eb; }
    .tab.active {
      background: #ef4444;
      color: #fff;
    }
    .tab-content { display: none; padding: 24px; }
    .tab-content.active { display: block; }

    /* Form grid */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px 24px;
    }
    .form-group { display: flex; flex-direction: column; gap: 6px; }
    .form-group.full { grid-column: 1 / -1; }
    label {
      font-size: 13px;
      font-weight: 600;
      color: #374151;
    }
    input[type="text"],
    input[type="number"],
    input[type="url"],
    select,
    textarea {
      padding: 9px 12px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
      transition: border-color .15s, box-shadow .15s;
    }
    input:focus, select:focus, textarea:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59,130,246,.15);
    }
    input.error, select.error, textarea.error {
      border-color: #ef4444;
      box-shadow: 0 0 0 3px rgba(239,68,68,.12);
    }
    .error-msg {
      font-size: 12px;
      color: #ef4444;
      display: none;
    }
    .error-msg.show { display: block; }
    input[readonly] {
      background: #f3f4f6;
      color: #6b7280;
    }
    .btn-link {
      display: inline-block;
      margin-top: 6px;
      padding: 6px 12px;
      font-size: 13px;
      border: 1px solid #d1d5db;
      border-radius: 4px;
      background: #fff;
      cursor: pointer;
    }
    .btn-link:hover { background: #f9fafb; }

    /* Actions */
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
      text-decoration: none;
      display: inline-flex;
      align-items: center;
    }
    .btn-secondary:hover { background: #f9fafb; }

    /* Toast */
    .toast {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 12px 20px;
      border-radius: 8px;
      color: #fff;
      font-size: 14px;
      opacity: 0;
      transform: translateY(-10px);
      transition: all .3s;
      z-index: 100;
    }
    .toast.show { opacity: 1; transform: translateY(0); }
    .toast.success { background: #10b981; }
    .toast.error { background: #ef4444; }

    @media (max-width: 768px) {
      .form-grid { grid-template-columns: 1fr; }
    }
  </style>
  <!-- CKEditor CDN -->
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>
<body>
  @php
    $isEdit = isset($product) && $product;
    $actionUrl = $isEdit ? '/backend/product/' . $product['id'] : '/backend/product/store';
  @endphp

  <div class="form-container">
    <div class="admin-menu">
      <div class="logo">Admin Dashboard</div>
      <nav>
        <a href="/backend/products">📦 Quản lý sản phẩm</a>
        <a href="/backend/categories">📁 Quản lý danh mục</a>
        <a href="/backend/product/create" class="{{ !$isEdit ? 'active' : '' }}">+ Thêm sản phẩm</a>
        <a href="/backend/category/create">+ Thêm danh mục</a>
        <a href="/" style="color: #9ca3af; font-size: 13px;">🌐 Xem Website</a>
      </nav>
    </div>

    <div class="top-nav">
      <h2>{{ $isEdit ? 'Sửa sản phẩm #' . $product['id'] : 'Thêm sản phẩm mới' }}</h2>
      <a href="/backend/products">← Quay lại danh sách quản lý</a>
    </div>

    <!-- Tabs -->
    <div class="tabs">
      <button class="tab active" data-tab="basic">Cơ bản</button>
      <button class="tab" data-tab="category">Danh mục</button>
      <button class="tab" data-tab="seo">SEO</button>
      <button class="tab" data-tab="desc">Mô tả</button>
      <button class="tab" data-tab="specs">Thông số</button>
      <button class="tab" data-tab="images">Ảnh</button>
      <button class="tab" data-tab="web">Xem tại web</button>
      <button class="tab" data-tab="display">Hiển thị</button>
    </div>

    <form id="productForm" novalidate data-is-edit="{{ $isEdit ? 'true' : 'false' }}" data-action="{{ $actionUrl }}">
      @csrf
      @if($isEdit)
        @method('PUT')
      @endif

      <!-- Tab: Cơ bản -->
      <div class="tab-content active" id="tab-basic">
        <div class="form-grid">
          <div class="form-group">
            <label for="tenSanPham">Tên sản phẩm: <span style="color:#ef4444">*</span></label>
            <input type="text" id="tenSanPham" name="tenSanPham" 
                   value="{{ $isEdit ? ($product['name'] ?? '') : 'Google Tivi TCL QD-Mini LED 55P8LS 55 inch 4K' }}"
                   placeholder="Nhập tên sản phẩm" required minlength="5" maxlength="200">
            <span class="error-msg" id="err-tenSanPham">Tên sản phẩm bắt buộc, tối thiểu 5 ký tự</span>
          </div>

          <div class="form-group">
            <label for="model">Model: <span style="color:#ef4444">*</span></label>
            <input type="text" id="model" name="model" value="{{ $isEdit ? ($product['code'] ?? ($product['model'] ?? '')) : '55P8LS' }}"
                   placeholder="Nhập model" required maxlength="50">
            <span class="error-msg" id="err-model">Model bắt buộc</span>
          </div>

          <div class="form-group">
            <label for="gia">Giá: <span style="color:#ef4444">*</span></label>
            <input type="number" id="gia" name="gia" value="{{ $isEdit ? ($product['price'] ?? 0) : '11850000' }}"
                   placeholder="0" required min="0" step="1000">
            <span class="error-msg" id="err-gia">Giá phải ≥ 0</span>
          </div>

          <div class="form-group">
            <label for="giaHang">Giá Hãng:</label>
            <input type="number" id="giaHang" name="giaHang" value="{{ $isEdit ? ($product['original_price'] ?? '') : '' }}" placeholder="0" min="0" step="1000">
            <span class="error-msg" id="err-giaHang">Giá hãng phải ≥ 0</span>
          </div>

          <div class="form-group">
            <label for="soLuong">Số lượng trong kho: <span style="color:#ef4444">*</span></label>
            <input type="number" id="soLuong" name="soLuong" value="{{ $isEdit ? ($product['quantity'] ?? ($product['stock'] ?? 0)) : '12' }}"
                   placeholder="0" required min="0" step="1">
            <span class="error-msg" id="err-soLuong">Số lượng phải ≥ 0</span>
          </div>

          <div class="form-group">
            <label for="hangPhanPhoi">Hãng phân phối: <span style="color:#ef4444">*</span></label>
            @php
              $currentBrand = $isEdit ? ($product['brand'] ?? '') : 'TCL';
            @endphp
            <select id="hangPhanPhoi" name="hangPhanPhoi" required>
              <option value="">-- Chọn hãng --</option>
              <option value="TCL" {{ $currentBrand == 'TCL' ? 'selected' : '' }}>TCL</option>
              <option value="Samsung" {{ $currentBrand == 'Samsung' ? 'selected' : '' }}>Samsung</option>
              <option value="LG" {{ $currentBrand == 'LG' ? 'selected' : '' }}>LG</option>
              <option value="Sony" {{ $currentBrand == 'Sony' ? 'selected' : '' }}>Sony</option>
              <option value="Xiaomi" {{ $currentBrand == 'Xiaomi' ? 'selected' : '' }}>Xiaomi</option>
              <option value="Khác" {{ $currentBrand == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
            <span class="error-msg" id="err-hangPhanPhoi">Vui lòng chọn hãng phân phối</span>
          </div>

          <div class="form-group">
            <label for="link">Link:</label>
            <input type="text" id="link" name="link" 
                   value="{{ $isEdit ? ($product['slug'] ?? '') : 'google-tivi-tcl-qd-mini-led-55p8ls-55-inch-4k' }}" readonly>
            <button type="button" class="btn-link" id="btnLinkKhac">Link khác</button>
          </div>

          <div class="form-group">
            <label for="linkRedirect">Link Redirect:</label>
            <input type="url" id="linkRedirect" name="linkRedirect" 
                   value="{{ $isEdit ? ($product['redirect_url'] ?? '') : '' }}"
                   placeholder="https://...">
            <span class="error-msg" id="err-linkRedirect">URL không hợp lệ</span>
          </div>

          <div class="form-group full">
            <label for="dacDiem">Đặc điểm nổi bật</label>
            <textarea name="dacDiemNoiBat" id="dacDiem">{!! $isEdit ? ($product['overview'] ?? '') : '<ul><li>Xuất xứ: Việt Nam</li><li>Bảo hành: 24 Tháng</li><li>Kích thước: 55 inch</li><li>Độ phân giải: 4K (3840*2160)</li><li>HDMI: 4 cổng</li></ul>' !!}</textarea>
          </div>
        </div>
      </div>

      <!-- Các tab khác (placeholder) -->
      <div class="tab-content" id="tab-category">
        <p style="color:#6b7280">Nội dung tab Danh mục</p>
      </div>
      <div class="tab-content" id="tab-seo">
        <p style="color:#6b7280">Nội dung tab SEO</p>
      </div>
      <div class="tab-content" id="tab-desc">
        <p style="color:#6b7280">Nội dung tab Mô tả</p>
      </div>
      <div class="tab-content" id="tab-specs">
        <p style="color:#6b7280">Nội dung tab Thông số</p>
      </div>
      <div class="tab-content" id="tab-images">
        <p style="color:#6b7280">Nội dung tab Ảnh</p>
      </div>
      <div class="tab-content" id="tab-web">
        <p style="color:#6b7280">Nội dung tab Xem tại web</p>
      </div>
      <div class="tab-content" id="tab-display">
        <p style="color:#6b7280">Nội dung tab Hiển thị</p>
      </div>

      <div class="form-actions">
        <a href="/backend/products" class="btn btn-secondary" id="btnCancel">Hủy</a>
        <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Cập nhật sản phẩm' : 'Lưu sản phẩm' }}</button>
      </div>
    </form>
  </div>

  <div class="toast" id="toast"></div>

  <script>
    // Initialize CKEditor
    CKEDITOR.replace('dacDiem');

    // ===== Tab switching =====
    document.querySelectorAll('.tab').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
      });
    });

    // ===== Auto generate slug từ tên sản phẩm =====
    const tenSanPham = document.getElementById('tenSanPham');
    const linkInput = document.getElementById('link');
    let linkManual = false;

    function slugify(str) {
      return str.toLowerCase()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
        .replace(/đ/g, 'd').replace(/Đ/g, 'D')
        .replace(/[^a-z0-9\s-]/g, '')
        .trim().replace(/\s+/g, '-').replace(/-+/g, '-');
    }

    tenSanPham.addEventListener('input', () => {
      if (!linkManual) {
        linkInput.value = slugify(tenSanPham.value);
      }
    });

    document.getElementById('btnLinkKhac').addEventListener('click', () => {
      linkManual = true;
      linkInput.removeAttribute('readonly');
      linkInput.focus();
      linkInput.style.background = '#fff';
      linkInput.style.color = '#333';
    });

    // ===== Validation helpers =====
    function showError(id, msg) {
      const input = document.getElementById(id);
      const err = document.getElementById('err-' + id);
      if (input) input.classList.add('error');
      if (err) {
        if (msg) err.textContent = msg;
        err.classList.add('show');
      }
    }
    function clearError(id) {
      const input = document.getElementById(id);
      const err = document.getElementById('err-' + id);
      if (input) input.classList.remove('error');
      if (err) err.classList.remove('show');
    }
    function clearAllErrors() {
      document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
      document.querySelectorAll('.error-msg').forEach(el => el.classList.remove('show'));
    }

    function validateForm() {
      clearAllErrors();
      let valid = true;

      const ten = tenSanPham.value.trim();
      if (!ten || ten.length < 5) {
        showError('tenSanPham');
        valid = false;
      }

      if (!document.getElementById('model').value.trim()) {
        showError('model');
        valid = false;
      }

      const gia = document.getElementById('gia').value;
      if (gia === '' || Number(gia) < 0) {
        showError('gia');
        valid = false;
      }

      const giaHang = document.getElementById('giaHang').value;
      if (giaHang !== '' && Number(giaHang) < 0) {
        showError('giaHang');
        valid = false;
      }

      const soLuong = document.getElementById('soLuong').value;
      if (soLuong === '' || Number(soLuong) < 0) {
        showError('soLuong');
        valid = false;
      }

      if (!document.getElementById('hangPhanPhoi').value) {
        showError('hangPhanPhoi');
        valid = false;
      }

      const redirect = document.getElementById('linkRedirect').value.trim();
      if (redirect) {
        try {
          new URL(redirect);
        } catch {
          showError('linkRedirect', 'URL không hợp lệ (phải bắt đầu bằng http:// hoặc https://)');
          valid = false;
        }
      }

      return valid;
    }

    ['tenSanPham', 'model', 'gia', 'giaHang', 'soLuong', 'hangPhanPhoi', 'linkRedirect']
      .forEach(id => {
        const el = document.getElementById(id);
        if (el) {
          el.addEventListener('input', () => clearError(id));
          el.addEventListener('change', () => clearError(id));
        }
      });

    // ===== Submit =====
    const productForm = document.getElementById('productForm');
    productForm.addEventListener('submit', function(e) {
      e.preventDefault();

      // Get content from CKEditor
      const dacDiemContent = CKEDITOR.instances.dacDiem ? CKEDITOR.instances.dacDiem.getData() : '';

      if (!validateForm()) {
        showToast('Vui lòng kiểm tra lại các trường bắt buộc', 'error');
        document.querySelector('.tab[data-tab="basic"]').click();
        return;
      }

      const data = {
        tenSanPham: tenSanPham.value.trim(),
        model: document.getElementById('model').value.trim(),
        gia: Number(document.getElementById('gia').value),
        giaHang: document.getElementById('giaHang').value 
                  ? Number(document.getElementById('giaHang').value) : null,
        soLuong: Number(document.getElementById('soLuong').value),
        hangPhanPhoi: document.getElementById('hangPhanPhoi').value,
        link: linkInput.value,
        linkRedirect: document.getElementById('linkRedirect').value.trim() || null,
        dacDiemNoiBat: dacDiemContent
      };

      const isEdit = productForm.dataset.isEdit === 'true';
      const actionUrl = productForm.dataset.action;
      const method = isEdit ? 'PUT' : 'POST';

      fetch(actionUrl, {
        method: method,
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(data)
      })
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          showToast(isEdit ? 'Cập nhật sản phẩm thành công!' : 'Lưu sản phẩm thành công!', 'success');
          setTimeout(() => {
            window.location.href = '/backend/products';
          }, 1500);
        } else {
          showToast(result.message || 'Có lỗi xảy ra', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showToast('Lỗi hệ thống!', 'error');
      });
    });

    // ===== Toast =====
    function showToast(msg, type = 'success') {
      const toast = document.getElementById('toast');
      toast.textContent = msg;
      toast.className = 'toast ' + type + ' show';
      setTimeout(() => toast.classList.remove('show'), 3000);
    }
  </script>
</body>
</html>
