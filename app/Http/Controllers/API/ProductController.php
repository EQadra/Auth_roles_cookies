<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Obtener todos los productos
    public function index()
    {
        return response()->json([
            'message' => 'Lista de productos',
            'data'    => Product::all(),
        ]);
    }

    // Crear nuevo producto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'metal_type'     => 'required|in:oro,plata',
            'grams'          => 'required|numeric|min:0',
            'purity'         => 'nullable|numeric|min:0|max:100',
            'price_per_gram' => 'required|numeric|min:0',
            'image'          => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);

        return response()->json(['message' => 'Producto creado', 'data' => $product], 201);
    }

    // Mostrar un producto específico
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json(['data' => $product]);
    }

    // Actualizar un producto existente
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validated = $request->validate([
            'name'           => 'sometimes|string|max:255',
            'metal_type'     => 'sometimes|in:oro,plata',
            'grams'          => 'sometimes|numeric|min:0',
            'purity'         => 'nullable|numeric|min:0|max:100',
            'price_per_gram' => 'sometimes|numeric|min:0',
            'image'          => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return response()->json(['message' => 'Producto actualizado', 'data' => $product]);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return response()->json(['message' => 'Producto eliminado']);
    }
}
