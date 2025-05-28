<?php
// Controller 3: ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    public function show($id): JsonResponse
    {
        $product = Product::with('category')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,category_id'
        ]);

        $product = Product::create($validated);
        return response()->json($product->load('category'), 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'string',
            'description' => 'string',
            'price' => 'integer|min:0',
            'stock' => 'integer|min:0',
            'category_id' => 'exists:categories,category_id'
        ]);

        $product->update($validated);
        return response()->json($product->load('category'));
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}