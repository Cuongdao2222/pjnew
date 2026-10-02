<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    public function test_can_view_products_management_index()
    {
        $response = $this->get('/backend/products');
        $response->assertStatus(200);
        $response->assertSee('Quản lý sản phẩm');
    }

    public function test_can_view_product_create_form()
    {
        $response = $this->get('/backend/product/create');
        $response->assertStatus(200);
        $response->assertSee('Thêm sản phẩm mới');
    }

    public function test_can_view_categories_management_index()
    {
        $response = $this->get('/backend/categories');
        $response->assertStatus(200);
        $response->assertSee('Quản lý danh mục');
    }

    public function test_can_view_category_create_form()
    {
        $response = $this->get('/backend/category/create');
        $response->assertStatus(200);
        $response->assertSee('Thêm danh mục');
    }
}
