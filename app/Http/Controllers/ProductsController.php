<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request) {
        $idCategory = $request->query('category_id');
        return response()->json(Product::where('category_id', $idCategory)->get());
    }
}
