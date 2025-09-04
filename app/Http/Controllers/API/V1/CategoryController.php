<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse{
        $categories = Category::select(['id', 'name', 'image', 'description', 'slug'])->get();
        return response()->json($categories);
    }
}
