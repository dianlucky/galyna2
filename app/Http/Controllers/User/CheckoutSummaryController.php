<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutSummaryController extends Controller
{
    public function showSummary(Request $request)
    {
        // Metode ini mungkin digunakan untuk menampilkan ringkasan checkout dari keranjang
        return response()->json(['message' => 'showSummary method placeholder'], 200);
    }

    /**
     * Menghitung biaya pengiriman menggunakan Raja Ongkir.
     * Metode ini dipanggil via AJAX dari frontend.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculateShippingCost(Request $request)
    {
        $request->validate([
            'courier' => 'required|string',
            'destination_address' => 'required|string', // Alamat lengkap, mungkin perlu diparse untuk kota/kabupaten
            'weight' => 'required|integer|min:1', // Berat dalam gram
            // Anda mungkin perlu menambahkan 'origin_city_id', 'destination_city_id' jika frontend tidak mengirim
            // dan Anda mencarinya di backend berdasarkan alamat.
        ]);

        // --- Konfigurasi Raja Ongkir ---
        $apiKey = env('RAJAONGKIR_API_KEY');
        $baseUrl = 'https://api.rajaongkir.com/starter/'; // Ganti sesuai akun Anda (starter/basic/pro)
        $originCityId = env('RAJAONGKIR_ORIGIN_CITY_ID'); // ID kota asal pengiriman Anda

        if (!$apiKey || !$originCityId) {
            Log::error('RajaOngkir API Key atau Origin City ID belum dikonfigurasi di .env');
            return response()->json(['success' => false, 'message' => 'Konfigurasi pengiriman belum lengkap (API Key/Origin City ID).'], 500);
        }

        $courier = $request->input('courier');
        $weight = $request->input('weight');
        $destinationAddress = $request->input('destination_address');

        // >>> LOGIKA MENCARI ID KOTA TUJUAN DARI ALAMAT <<<
        // Ini adalah bagian KRUSIAL. Anda perlu memetakan 'destination_address' menjadi 'destination_city_id' Raja Ongkir.
        // Opsi:
        // 1. Simpan daftar kota Raja Ongkir di DB Anda dan cari berdasarkan nama/keyword dari $destinationAddress.
        // 2. Gunakan API Raja Ongkir 'city' untuk mencari ID kota.
        // Untuk contoh ini, kita akan menggunakan placeholder. Anda harus mengganti ini dengan logika nyata Anda.
        $destinationCityId = '501'; // CONTOH: ID kota tujuan (misal: Jakarta Selatan). GANTI INI!
        // Jika Anda memiliki data kota di DB Anda, Anda bisa mencari:
        // $destinationCity = YourCityModel::where('name', 'like', '%' . $destinationAddress . '%')->first();
        // if ($destinationCity) { $destinationCityId = $destinationCity->rajaongkir_city_id; } else { throw new \Exception('Kota tujuan tidak ditemukan'); }

        if (!$destinationCityId) {
            return response()->json(['success' => false, 'message' => 'Kota tujuan tidak dapat diidentifikasi dari alamat.'], 400);
        }

        try {
            // --- Panggil API Raja Ongkir untuk mendapatkan biaya ---
            $response = Http::withHeaders([
                'key' => $apiKey,
            ])->post("{$baseUrl}cost", [
                'origin'        => $originCityId,
                'destination'   => $destinationCityId,
                'weight'        => $weight,
                'courier'       => $courier,
            ]);

            $result = $response->json();

            Log::info('RajaOngkir API Response:', $result);

            if ($result && $result['rajaongkir']['status']['code'] == 200) {
                $costs = $result['rajaongkir']['results'][0]['costs'];

                if (!empty($costs)) {
                    // Ambil biaya pengiriman termurah atau opsi pertama
                    $costDetails = $costs[0]['cost'][0]; // Ambil detail biaya pertama (value, etd)
                    
                    return response()->json([
                        'success' => true,
                        'cost' => $costDetails['value'],
                        'etd' => $costDetails['etd'],
                        'message' => 'Biaya pengiriman berhasil dihitung.'
                    ]);
                } else {
                    return response()->json(['success' => false, 'message' => 'Tidak ada biaya pengiriman ditemukan untuk kurir ini.'], 404);
                }
            } else {
                return response()->json(['success' => false, 'message' => $result['rajaongkir']['status']['description'] ?? 'API RajaOngkir Error.'], $result['rajaongkir']['status']['code'] ?? 500);
            }

        } catch (\Exception $e) {
            Log::error('Error saat memanggil RajaOngkir API: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan internal saat menghitung ongkir.'], 500);
        }
    }
}
