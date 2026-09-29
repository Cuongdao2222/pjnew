<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form nhập liệu sản phẩm</title>
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
      color: #374151;
    }
    .btn-link:hover { background: #f9fafb; }

    /* Rich text toolbar (giả) */
    .editor-toolbar {
      display: flex;
      flex-wrap: wrap;
      gap: 2px;
      padding: 8px;
      background: #f9fafb;
      border: 1px solid #d1d5db;
      border-bottom: none;
      border-radius: 6px 6px 0 0;
      font-size: 13px;
    }
    .editor-toolbar button {
      padding: 4px 8px;
      border: none;
      background: transparent;
      border-radius: 3px;
      cursor: pointer;
      color: #4b5563;
    }
    .editor-toolbar button:hover { background: #e5e7eb; }
    .editor-area {
      border: 1px solid #d1d5db;
      border-radius: 0 0 6px 6px;
      min-height: 160px;
      padding: 12px;
      font-size: 14px;
      line-height: 1.6;
      outline: none;
    }
    .editor-area:focus { border-color: #3b82f6; }
    .editor-area ul { padding-left: 20px; }
    .editor-area li { margin-bottom: 4px; }

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
</head>
<body>
  <div class="form-container">
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

    <form id="productForm" novalidate>
      @csrf
      <!-- Tab: Cơ bản -->
      <div class="tab-content active" id="tab-basic">
        <div class="form-grid">
          <div class="form-group">
            <label for="tenSanPham">Tên sản phẩm: <span style="color:#ef4444">*</span></label>
            <input type="text" id="tenSanPham" name="tenSanPham" 
                   value="Google Tivi TCL QD-Mini LED 55P8LS 55 inch 4K"
                   placeholder="Nhập tên sản phẩm" required minlength="5" maxlength="200">
            <span class="error-msg" id="err-tenSanPham">Tên sản phẩm bắt buộc, tối thiểu 5 ký tự</span>
          </div>

          <div class="form-group">
            <label for="model">Model: <span style="color:#ef4444">*</span></label>
            <input type="text" id="model" name="model" value="55P8LS"
                   placeholder="Nhập model" required maxlength="50">
            <span class="error-msg" id="err-model">Model bắt buộc</span>
          </div>

          <div class="form-group">
            <label for="gia">Giá: <span style="color:#ef4444">*</span></label>
            <input type="number" id="gia" name="gia" value="11850000"
                   placeholder="0" required min="0" step="1000">
            <span class="error-msg" id="err-gia">Giá phải ≥ 0</span>
          </div>

          <div class="form-group">
            <label for="giaHang">Giá Hãng:</label>
            <input type="number" id="giaHang" name="giaHang" placeholder="0" min="0" step="1000">
            <span class="error-msg" id="err-giaHang">Giá hãng phải ≥ 0</span>
          </div>

          <div class="form-group">
            <label for="soLuong">Số lượng trong kho: <span style="color:#ef4444">*</span></label>
            <input type="number" id="soLuong" name="soLuong" value="12"
                   placeholder="0" required min="0" step="1">
            <span class="error-msg" id="err-soLuong">Số lượng phải ≥ 0</span>
          </div>

          <div class="form-group">
            <label for="hangPhanPhoi">Hãng phân phối: <span style="color:#ef4444">*</span></label>
            <select id="hangPhanPhoi" name="hangPhanPhoi" required>
              <option value="">-- Chọn hãng --</option>
              <option value="TCL" selected>TCL</option>
              <option value="Samsung">Samsung</option>
              <option value="LG">LG</option>
              <option value="Sony">Sony</option>
              <option value="Xiaomi">Xiaomi</option>
              <option value="Khác">Khác</option>
            </select>
            <span class="error-msg" id="err-hangPhanPhoi">Vui lòng chọn hãng phân phối</span>
          </div>

          <div class="form-group">
            <label for="link">Link:</label>
            <input type="text" id="link" name="link" 
                   value="google-tivi-tcl-qd-mini-led-55p8ls-55-inch-4k" readonly>
            <button type="button" class="btn-link" id="btnLinkKhac">Link khác</button>
          </div>

          <div class="form-group">
            <label for="linkRedirect">Link Redirect:</label>
            <input type="url" id="linkRedirect" name="linkRedirect" 
                   placeholder="https://...">
            <span class="error-msg" id="err-linkRedirect">URL không hợp lệ</span>
          </div>

          <div class="form-group full">
            <label>Đặc điểm nổi bật</label>
            <div class="editor-toolbar">
              <button type="button" title="Bold"><b>B</b></button>
              <button type="button" title="Italic"><i>I</i></button>
              <button type="button" title="Underline"><u>U</u></button>
              <button type="button">• List</button>
              <button type="button">1. List</button>
              <button type="button">🔗</button>
              <button type="button">🖼️</button>
            </div>
            <div class="editor-area" id="dacDiem" contenteditable="true">
              <ul>
                <li>Xuất xứ: Việt Nam</li>
                <li>Bảo hành: 24 Tháng</li>
                <li>Kích thước: 55 inch</li>
                <li>Độ phân giải: 4K (3840*2160)</li>
                <li>HDMI: 4 cổng</li>
              </ul>
            </div>
            <input type="hidden" name="dacDiemNoiBat" id="dacDiemHidden">
          </div>
        </div>
      </div>

      <!-- Các tab khác (placeholder) -->
      <div class="tab-content" id="tab-category">
        <p style="color:#6b7280">Nội dung tab Danh mục (có thể mở rộng sau)</p>
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
        <button type="button" class="btn btn-secondary" id="btnCancel">Hủy</button>
        <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
      </div>
    </form>
  </div>

  <div class="toast" id="toast"></div>

  <script>
    // ===== Tab switching =====
    document.querySelectorAll('.tab').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
      });
    });

    // ===== Auto generate slug from tên sản phẩm =====
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
      input.classList.add('error');
      if (err) {
        if (msg) err.textContent = msg;
        err.classList.add('show');
      }
    }
    function clearError(id) {
      const input = document.getElementById(id);
      const err = document.getElementById('err-' + id);
      input.classList.remove('error');
      if (err) err.classList.remove('show');
    }
    function clearAllErrors() {
      document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
      document.querySelectorAll('.error-msg').forEach(el => el.classList.remove('show'));
    }

    // ===== Validate form =====
    function validateForm() {
      clearAllErrors();
      let valid = true;

      // Tên sản phẩm
      const ten = tenSanPham.value.trim();
      if (!ten || ten.length < 5) {
        showError('tenSanPham');
        valid = false;
      }

      // Model
      if (!document.getElementById('model').value.trim()) {
        showError('model');
        valid = false;
      }

      // Giá
      const gia = document.getElementById('gia').value;
      if (gia === '' || Number(gia) < 0) {
        showError('gia');
        valid = false;
      }

      // Giá hãng (optional nhưng nếu có thì ≥ 0)
      const giaHang = document.getElementById('giaHang').value;
      if (giaHang !== '' && Number(giaHang) < 0) {
        showError('giaHang');
        valid = false;
      }

      // Số lượng
      const soLuong = document.getElementById('soLuong').value;
      if (soLuong === '' || Number(soLuong) < 0) {
        showError('soLuong');
        valid = false;
      }

      // Hãng phân phối
      if (!document.getElementById('hangPhanPhoi').value) {
        showError('hangPhanPhoi');
        valid = false;
      }

      // Link Redirect (optional, nhưng phải là URL hợp lệ nếu có)
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

    // Real-time clear error on input
    ['tenSanPham', 'model', 'gia', 'giaHang', 'soLuong', 'hangPhanPhoi', 'linkRedirect']
      .forEach(id => {
        const el = document.getElementById(id);
        el.addEventListener('input', () => clearError(id));
        el.addEventListener('change', () => clearError(id));
      });

    // ===== Submit =====
    document.getElementById('productForm').addEventListener('submit', function(e) {
      e.preventDefault();

      // Sync contenteditable vào hidden
      document.getElementById('dacDiemHidden').value = 
        document.getElementById('dacDiem').innerHTML;

      if (!validateForm()) {
        showToast('Vui lòng kiểm tra lại các trường bắt buộc', 'error');
        // Chuyển về tab Cơ bản nếu đang ở tab khác
        document.querySelector('.tab[data-tab="basic"]').click();
        return;
      }

      // Collect data
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
        dacDiemNoiBat: document.getElementById('dacDiemHidden').value
      };

      console.log('Dữ liệu form:', data);
      
      fetch('/backend/product/store', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(data)
      })
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          showToast('Lưu sản phẩm thành công!', 'success');
          setTimeout(() => {
            window.location.href = '/';
          }, 2000);
        } else {
          showToast('Có lỗi xảy ra khi lưu sản phẩm', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showToast('Lỗi hệ thống!', 'error');
      });
    });

    document.getElementById('btnCancel').addEventListener('click', () => {
      if (confirm('Bạn có chắc muốn hủy? Dữ liệu chưa lưu sẽ bị mất.')) {
        location.reload();
      }
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