<?php

namespace App\Controllers\Admin;

use App\Models\Product;

class ProductController
{
    public function index()
    {
        $productModel = new Product();
        $result = $productModel->get();
        require_once '../views/admin/products/index.php';
    }

    public function edit($arg)
    {
        $id = $arg[1];
        $productModel = new Product();

        $product = $productModel->find($id);

        require_once '../views/admin/products/edit.php';
    }
}