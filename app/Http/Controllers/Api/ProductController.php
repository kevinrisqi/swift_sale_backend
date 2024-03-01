<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();

        if ($products === null) {
            return ResponseFormatter::error(null, 'Data produk tidak ditemukan', 404);
        }

        return ResponseFormatter::success($products, 'Data produk berhasil diambil');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->validated();

        $product = Product::create($request->all());

        if ($product === null) {
            return ResponseFormatter::error(null, 'Produk gagal ditambahkan', 500);
        }

        return ResponseFormatter::success($product, 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if ($product === null) {
            return ResponseFormatter::error(null, 'Data produk tidak ditemukan', 404);
        }

        return ResponseFormatter::success($product, 'Data produk berhasil diambil');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, string $id)
    {
        $product = Product::find($id);

        if ($product === null) {
            return ResponseFormatter::error(null, 'Data produk tidak ditemukan', 404);
        }

        $request->validated();

        $product->update($request->all());

        return ResponseFormatter::success($product, 'Data produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product === null) {
            return ResponseFormatter::error(null, 'Data produk tidak ditemukan', 404);
        }

        $product->delete();

        return ResponseFormatter::success(null, 'Data produk berhasil dihapus');
    }
}
