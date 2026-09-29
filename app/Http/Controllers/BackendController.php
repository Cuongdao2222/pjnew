<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BackendController extends Controller
{
    private function getProducts()
    {
        $path = database_path('products.json');
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    private function saveProducts($products)
    {
        $path = database_path('products.json');
        File::put($path, json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function create()
    {
        return view('Backend.form');
    }

    public function store(Request $request)
    {
        $products = $this->getProducts();
        
        $newId = count($products) > 0 ? max(array_column($products, 'id')) + 1 : 1;
        
        $newProduct = [
            'id' => $newId,
            'name' => $request->input('tenSanPham'),
            'slug' => $request->input('link'),
            'code' => $request->input('model'),
            'price' => (float)$request->input('gia'),
            'original_price' => (float)$request->input('giaHang'),
            'stock' => (int)$request->input('soLuong'),
            'brand' => $request->input('hangPhanPhoi'),
            'redirect_url' => $request->input('linkRedirect'),
            'overview' => $request->input('dacDiemNoiBat'),
            'description' => $request->input('dacDiemNoiBat'), // Default to same as overview for now
            'images' => [
                "https://via.placeholder.com/480x360/333/fff?text=" . urlencode($request->input('tenSanPham'))
            ]
        ];

        $products[] = $newProduct;
        $this->saveProducts($products);

        return response()->json(['success' => true, 'product' => $newProduct]);
    }
}
