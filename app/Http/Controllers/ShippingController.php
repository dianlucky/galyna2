<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    public function getShippingCost(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('KOMERCE_API_KEY')
        ])->get('https://api.komerce.id/rajaongkir/cost', [
            'origin' => $request->origin,          // ID kota asal
            'destination' => $request->destination, // ID kota tujuan
            'weight' => $request->weight,           // dalam gram
            'courier' => $request->courier          // misal: jne / pos / tiki
        ]);

        return response()->json($response->json());
    }
}
