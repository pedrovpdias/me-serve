<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // Retorna todos os produtos de uma categoria
    public function index(Request $request) {
        $idCategory = $request->query('category_id'); // Pega o id da categoria
        return response()->json(Product::where('category_id', $idCategory)->get()); // Retorna os produtos
    }
}
