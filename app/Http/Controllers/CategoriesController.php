<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Busca todas as categorias do cardápio
    public function index() {
        return response()->json(Category::orderBy('order', 'asc')->get()); // Retorna as categorias
    }
}
