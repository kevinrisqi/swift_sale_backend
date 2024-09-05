<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'selling_price' => 'required|integer',
            'purchase_price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'nullable|string',
            'category' => 'required|string|in:snack,food,drink',
        ]);

        $base64String = $data['image'];

        $encodedString = explode(',', $base64String, 2);
        $decodedImage = str_replace(' ', '+', $encodedString[1]);

        $decodedImage = base64_decode($decodedImage);

        $filename = time() . '.jpg';

        Storage::put('public/products/' . $filename, $decodedImage);

        $data['image'] = $filename;

        $product = Product::create($data);

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
    public function update(Request $request, string $id)
    {
        // $data = $request->validate([
        //     'name' => 'required|string',
        //     'description' => 'nullable|string',
        //     'selling_price' => 'required|integer',
        //     'purchase_price' => 'required|integer',
        //     'stock' => 'required|integer',
        //     'image' => 'nullable|string',
        //     'category' => 'required|string|in:snack,food,drink',
        // ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'selling_price' => 'required|integer',
            'purchase_price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'nullable|string',
            'category' => 'required|string|in:snack,food,drink',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $product = Product::find($id);

        if ($product === null) {
            return ResponseFormatter::error(null, 'Data produk tidak ditemukan', 404);
        }


        $base64String = $request['image'];

        $encodedString = explode(',', $base64String, 2);
        $decodedImage = str_replace(' ', '+', $encodedString[1]);

        $decodedImage = base64_decode($decodedImage);

        $filename = time() . '.jpg';

        Storage::put('public/products/' . $filename, $decodedImage);

        $data['image'] = $filename;

        $product->update($data);

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
