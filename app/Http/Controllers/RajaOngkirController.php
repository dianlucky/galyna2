<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RajaOngkirController extends Controller
{
    public function getDestination(Request $request)
{
    $request->validate([
        'keyword' => 'required|string|min:2'
    ]);

    $cacheKey = 'destination_' . md5($request->keyword);
    
    // Cek cache terlebih dahulu
    $cached = Cache::get($cacheKey);
    if ($cached) {
        return response()->json([
            'success' => true,
            'results' => $cached
        ]);
    }

    try {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get(env('RAJAONGKIR_API_BASE_URL') . "/destination/domestic-destination", [
            'keyword' => $request->keyword
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $results = collect($data['data'] ?? [])->take(10);
            
            // Cache hasil selama 1 jam
            Cache::put($cacheKey, $results, 3600);
            
            return response()->json([
                'success' => true,
                'results' => $results
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mencari destinasi.',
            'error' => $response->json()
        ], $response->status());
    } catch (\Exception $e) {
        Log::error('RAJAONGKIR Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}
    
}
