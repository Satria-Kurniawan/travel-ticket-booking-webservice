<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function storeKategori(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|unique:kategori,name',
            'trending' => 'boolean'
        ]);

        $kategori = Kategori::create([
            'name' => $fields['name'],
            'trending' => $fields['trending']
        ]);

        return response([
            'message' => 'Success',
            'kategori' => $kategori
        ], 201);
    }

    public function getKategori()
    {
        $kategori = Kategori::all();

        return response([
            'message' => 'Success',
            'kategori' => $kategori
        ], 200);
    }
}
