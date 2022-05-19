<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function storeBooking(Request $request)
    {
        $fields = $request->validate([
            'jumlah_tiket' => 'required|integer',
        ]);

        $pesanan = Pesanan::create([
            'jumlah_tiket' => $fields['jumlah_tiket'],
            'tempat_wisata' => $request->tempat_wisata,
            'nama_pemesan' => Auth::user()->name
        ], 201);

        $tiket = Tiket::create([
            'kode_tiket' => 'TK-' . rand(1, 99999),
            'jumlah_tiket' => $fields['jumlah_tiket'],
            'pemilik_tiket' => Auth::user()->name
        ], 201);

        return response([
            'message' => 'Success',
            'pesanan' => $pesanan,
            'tiket' => $tiket
        ], 201);
    }

    public function getBooking()
    {
        $pesanan = Pesanan::all();

        return response([
            'message' => 'Success',
            'daftar_pesanan' => $pesanan
        ], 200);
    }

    public function getBookingById($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        return response([
            'message' => 'Success',
            'daftar_pesanan' => $pesanan
        ], 200);
    }
}
