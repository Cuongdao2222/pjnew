<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

class BackendController extends Controller
{
    private function getProducts()
    {
        $path = database_path('products.json');
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true) ?: [];
    }

    private function saveProducts($products)
    {
        $path = database_path('products.json');
        File::put($path, json_encode(array_values($products), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function index(Request $request)
    {
        $products = $this->getProducts();

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($products, ($currentPage - 1) * $perPage, $perPage);

        $paginatedProducts = new LengthAwarePaginator(
            $currentItems,
            count($products),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('Backend.index', ['products' => $paginatedProducts]);
    }

    public function create()
    {
        $product = null;
        return view('Backend.form', compact('product'));
    }

    public function store(Request $request)
    {
        $products = $this->getProducts();
        
        $newId = count($products) > 0 ? max(array_column($products, 'id')) + 1 : 1;
        
        $newProduct = [
            'id' => $newId,
            'name' => $request->input('tenSanPham'),
            'slug' => $request->input('link') ?: Str::slug($request->input('tenSanPham')),
            'code' => $request->input('model'),
            'price' => (float)$request->input('gia'),
            'original_price' => (float)$request->input('giaHang', 0),
            'quantity' => (int)$request->input('soLuong'),
            'stock' => (int)$request->input('soLuong'),
            'brand' => $request->input('hangPhanPhoi'),
            'category' => $request->input('category', 'may-tinh-bang'),
            'redirect_url' => $request->input('linkRedirect'),
            'overview' => $request->input('dacDiemNoiBat'),
            'description' => $request->input('dacDiemNoiBat'),
            'rating' => 5.0,
            'images' => [
                "https://via.placeholder.com/480x360/333/fff?text=" . urlencode($request->input('tenSanPham'))
            ]
        ];

        $products[] = $newProduct;
        $this->saveProducts($products);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'product' => $newProduct]);
        }

        return redirect('/backend/products')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $products = $this->getProducts();
        $product = collect($products)->firstWhere('id', (int)$id);

        if (!$product) {
            return redirect('/backend/products')->with('error', 'Không tìm thấy sản phẩm!');
        }

        return view('Backend.form', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $products = $this->getProducts();
        $found = false;

        foreach ($products as &$product) {
            if ($product['id'] == (int)$id) {
                $product['name'] = $request->input('tenSanPham', $product['name']);
                $product['slug'] = $request->input('link', $product['slug']);
                $product['code'] = $request->input('model', $product['code']);
                $product['price'] = (float)$request->input('gia', $product['price']);
                $product['original_price'] = (float)$request->input('giaHang', $product['original_price'] ?? 0);
                $product['quantity'] = (int)$request->input('soLuong', $product['quantity'] ?? 0);
                $product['stock'] = (int)$request->input('soLuong', $product['stock'] ?? 0);
                $product['brand'] = $request->input('hangPhanPhoi', $product['brand'] ?? '');
                $product['redirect_url'] = $request->input('linkRedirect', $product['redirect_url'] ?? '');
                if ($request->filled('dacDiemNoiBat')) {
                    $product['overview'] = $request->input('dacDiemNoiBat');
                    $product['description'] = $request->input('dacDiemNoiBat');
                }
                $found = true;
                break;
            }
        }
        unset($product);

        if (!$found) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm'], 404);
            }
            return redirect('/backend/products')->with('error', 'Không tìm thấy sản phẩm');
        }

        $this->saveProducts($products);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect('/backend/products')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy($id)
    {
        $products = $this->getProducts();
        $products = array_filter($products, function($p) use ($id) {
            return $p['id'] != (int)$id;
        });

        $this->saveProducts($products);

        return redirect('/backend/products')->with('success', 'Xóa sản phẩm thành công!');
    }

    private function getCategories()
    {
        $path = database_path('categories.json');
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true) ?: [];
    }

    private function saveCategories($categories)
    {
        $path = database_path('categories.json');
        File::put($path, json_encode(array_values($categories), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function categoriesIndex()
    {
        $categories = $this->getCategories();
        return view('Backend.categories', compact('categories'));
    }

    public function categoryCreate()
    {
        $categories = $this->getCategories();
        return view('Backend.category-form', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $categories = $this->getCategories();
        $name = $request->input('tên');
        $slug = $request->input('slug') ?: Str::slug($name);
        $image = $request->input('đường dẫn ảnh') ?: 'https://via.placeholder.com/300x300?text=' . urlencode($name);
        $parentId = $request->input('parent_id');

        if ($parentId !== null && $parentId !== '') {
            $added = false;
            $addSub = function (&$list) use ($parentId, $name, $slug, $image, &$addSub, &$added) {
                foreach ($list as &$cat) {
                    if (isset($cat['id']) && $cat['id'] == (int)$parentId) {
                        if (!isset($cat['subcategories'])) {
                            $cat['subcategories'] = [];
                        }
                        $cat['subcategories'][] = [
                            'tên' => $name,
                            'slug' => $slug,
                            'đường dẫn ảnh' => $image,
                            'subcategories' => []
                        ];
                        $added = true;
                        return;
                    }
                    if (!empty($cat['subcategories'])) {
                        $addSub($cat['subcategories']);
                        if ($added) return;
                    }
                }
            };
            $addSub($categories);
            if (!$added) {
                $newId = count($categories) > 0 ? max(array_column($categories, 'id')) + 1 : 1;
                $categories[] = [
                    'id' => $newId,
                    'tên' => $name,
                    'slug' => $slug,
                    'đường dẫn ảnh' => $image,
                    'subcategories' => []
                ];
            }
        } else {
            $newId = count($categories) > 0 ? max(array_column($categories, 'id')) + 1 : 1;
            $categories[] = [
                'id' => $newId,
                'tên' => $name,
                'slug' => $slug,
                'đường dẫn ảnh' => $image,
                'subcategories' => []
            ];
        }

        $this->saveCategories($categories);

        return redirect('/backend/categories')->with('success', 'Thêm danh mục thành công!');
    }

    public function categoryDestroy($id)
    {
        $categories = $this->getCategories();
        
        $removeCat = function (&$list) use ($id, &$removeCat) {
            foreach ($list as $key => &$cat) {
                if (isset($cat['id']) && $cat['id'] == (int)$id) {
                    unset($list[$key]);
                    return true;
                }
                if (!empty($cat['subcategories'])) {
                    if ($removeCat($cat['subcategories'])) {
                        $cat['subcategories'] = array_values($cat['subcategories']);
                        return true;
                    }
                }
            }
            return false;
        };

        $removeCat($categories);
        $this->saveCategories(array_values($categories));

        return redirect('/backend/categories')->with('success', 'Xóa danh mục thành công!');
    }
}
