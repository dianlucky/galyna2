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
            'keyword' => 'required|string|min:2',
        ]);

        $cacheKey = 'destination_' . md5($request->keyword);

        // Cek cache terlebih dahulu
        $cached = Cache::get($cacheKey);
        if ($cached) {
            return response()->json([
                'success' => true,
                'results' => $cached,
            ]);
        }

        try {
            $response = Http::withHeaders([
                'key' => env('RAJAONGKIR_API_KEY'),
            ])->get(env('RAJAONGKIR_API_BASE_URL') . '/destination/domestic-destination', [
                'search' => $request->keyword,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $results = collect($data['data'] ?? [])->take(10);

                // Cache hasil selama 1 jam
                Cache::put($cacheKey, $results, 3600);

                return response()->json([
                    'success' => true,
                    'results' => $results,
                ]);
            }

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal mencari destinasi.',
                    'error' => $response->json(),
                ],
                $response->status(),
            );
        } catch (\Exception $e) {
            Log::error('RAJAONGKIR Error: ' . $e->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }
    public function calculateDomesticCost(Request $request)
    {
        $request->validate([
            'origin' => 'required|integer',
            'destination' => 'required|integer',
            'weight' => 'required|integer|min:1',
            'courier' => 'required|string|in:jne,pos,tiki',
        ]);

        try {
            $response = Http::asForm() // ⬅️ penting!
                ->withHeaders([
                    'key' => env('RAJAONGKIR_API_KEY'),
                ])
                ->post(env('RAJAONGKIR_API_BASE_URL') . '/calculate/domestic-cost', [
                    'origin' => env('RAJAONGKIR_ORIGIN_CITY_ID'),
                    'destination' => $request->destination,
                    'weight' => $request->weight,
                    'courier' => $request->courier,
                ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()['data'] ?? [],
                ]);
            }

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal menghitung ongkir.',
                    'error' => $response->json(),
                ],
                $response->status(),
            );
        } catch (\Exception $e) {
            Log::error('RAJAONGKIR COST ERROR: ' . $e->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }
}
