<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        if ($users === null) {
            return ResponseFormatter::error(null, 'Data user tidak ditemukan', 404);
        }

        return ResponseFormatter::success($users, 'Data user berhasil diambil');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|min:10|max:15',
            'roles' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create($requestData);

        if ($user === null) {
            return ResponseFormatter::error(null, 'Data user gagal ditambahkan', 500);
        }

        return ResponseFormatter::success($user, 'Data user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if ($user === null) {
            return ResponseFormatter::error(null, 'Data user tidak ditemukan', 404);
        }

        return ResponseFormatter::success($user, 'Data user berhasil diambil');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,',
            'phone' => 'required|string|min:10|max:15',
            'roles' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $user = User::find($id);

        if ($user === null) {
            return ResponseFormatter::error(null, 'Data user tidak ditemukan', 404);
        }

        $user->update($requestData);

        return ResponseFormatter::success($user, 'Data user berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user === null) {
            return ResponseFormatter::error(null, 'Data user tidak ditemukan', 404);
        }

        $user->delete();

        return ResponseFormatter::success(null, 'Data user berhasil dihapus');
    }
}
