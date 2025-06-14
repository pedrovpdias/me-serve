<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index($id) {
        return response()->json(Product::find($id)); // Retorna o produto
    }
}
