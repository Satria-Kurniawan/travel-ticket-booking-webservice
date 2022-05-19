<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function storeWisata(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|unique:wisata,name',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'required',
            'category_id' => 'required|integer'
        ]);

        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('public/images', $fileName);
        $filePath = asset('storage/images/' . $fileName);

        $wisata = Wisata::create([
            'name' => $fields['name'],
            'location' => $fields['location'],
            'description' => $fields['description'],
            'image' => $filePath,
            'category_id' => $fields['category_id']
        ]);

        return response([
            'message' => 'success',
            'wisata' => $wisata
        ], 201);
    }

    public function getWisata()
    {
        $wisata = Wisata::all();

        return response([
            'message' => 'success',
            'wisata' => $wisata
        ], 200);
    }

    public function getWisataById($id)
    {
        $wisata = Wisata::findOrFail($id);

        return response([
            'message' => 'success',
            'wisata' => $wisata
        ], 200);
    }

    public function updateWisata(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 'required|string|unique:wisata,name',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'required',
            'category_id' => 'required|integer'
        ]);

        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('public/images', $fileName);
        $filePath = asset('storage/images/' . $fileName);

        $wisata = Wisata::findOrFail($id);
        $wisata->update([
            'name' => $fields['name'],
            'location' => $fields['location'],
            'description' => $fields['description'],
            'image' => $filePath,
            'category_id' => $fields['category_id']
        ]);

        return response([
            'message' => 'success',
            'wisata' => $wisata
        ], 200);
    }

    public function deleteWisata($id)
    {
        $wisata = Wisata::findOrFail($id);
        $wisata->delete();

        return response([
            'message' => 'success',
        ], 200);
    }
}
