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

    public function show(Request $request) {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);
        $sortField = $request->input('sort', 'id'); // Valor padrão para ordenação
        $sortDirection = $request->input('direction', 'desc'); // Valor padrão para direção
        

        $products = Product::select('products.*', 'categories.name as category_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage); // Paginação dos produtos
        return response()->json($products);
    }

    public function latestProducts() {
        return response()->json(Product::latest()->take(5)->orderBy('id', 'desc') ->get()); // Retorna os 5 produtos mais recentes
    }
}
