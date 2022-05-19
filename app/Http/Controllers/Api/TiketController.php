<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function getTiketById($id)
    {
        $tiket = Tiket::findOrFail($id);

        return response([
            'message' => 'Success',
            'tiket' => $tiket
        ], 200);
    }
}
