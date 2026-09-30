<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Services\CartService;

class BlogController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    private function getProducts()
    {
        $path = database_path('products.json');
        if (!File::exists($path)) {
            return [];
        }
        return json_decode(File::get($path), true);
    }

    private function getCategories()
    {
        $path = database_path('categories.json');
        if (!File::exists($path)) {
            $pathAlt = database_path('category.json');
            if (File::exists($pathAlt)) {
                $path = $pathAlt;
            } else {
                return [];
            }
        }
        return json_decode(File::get($path), true);
    }

    public function index()
    {
        $products = $this->getProducts();
        $categories = $this->getCategories();
        return view('index', compact('products', 'categories'));
    }

    public function category($slug = null)
    {
        $allProducts = $this->getProducts();
        $categories = $this->getCategories();
        $products = [];

        if ($slug) {
            foreach ($allProducts as $p) {
                if (isset($p['category']) && $p['category'] == $slug) {
                    $products[] = $p;
                }
            }
        } else {
            if (count($categories) > 0) {
                $slug = $categories[0]['slug'];
                foreach ($allProducts as $p) {
                    if (isset($p['category']) && $p['category'] == $slug) {
                        $products[] = $p;
                    }
                }
            }
            if (empty($products)) {
                $products = $allProducts;
            }
        }

        return view('category', compact('products', 'categories', 'slug'));
    }

    public function detail($slug = null)
    {
        $products = $this->getProducts();
        $product = null;

        if ($slug) {
            foreach ($products as $p) {
                if (isset($p['slug']) && $p['slug'] == $slug) {
                    $product = $p;
                    break;
                }
            }
        }

        if (!$product && count($products) > 0) {
            $product = $products[0]; // Fallback to first product
        }

        return view('detail', compact('product'));
    }

    public function suggest(Request $request)
    {
        $query = $request->get('query');
        $products = $this->getProducts();
        $suggestions = [];

        if ($query) {
            foreach ($products as $p) {
                if (stripos($p['code'], $query) !== false || stripos($p['name'], $query) !== false) {
                    $suggestions[] = [
                        'code' => $p['code'],
                        'name' => $p['name'],
                        'slug' => $p['slug'],
                        'image' => $p['images'][0]
                    ];
                }
            }
        }

        return response()->json($suggestions);
    }

    public function viewCart()
    {
        $items = $this->cartService->getItems();
        return view('cart', compact('items'));
    }

    public function addToCart(Request $request)
    {
        $id = $request->input('id');
        $products = $this->getProducts();
        $product = null;
        
        foreach ($products as $p) {
            if ($p['id'] == $id) {
                $product = $p;
                break;
            }
        }

        if ($product) {
            $count = $this->cartService->add($product);
            return response()->json(['success' => true, 'cart_count' => $count]);
        }
        
        return response()->json(['success' => false], 404);
    }

    public function getCartCount()
    {
        return response()->json(['count' => $this->cartService->getCount()]);
    }
}
