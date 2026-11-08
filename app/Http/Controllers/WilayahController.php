<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WilayahController extends Controller
{
    private string $primaryBase = 'https://kanglerian.github.io/api-wilayah-indonesia/api';
    private string $secondaryBase = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    /**
     * Helper untuk fetch data wilayah dengan fallback dan cache 30 hari
     */
    private function fetchWilayah(string $path): array
    {
        $cacheKey = 'wilayah_' . md5($path);
        return Cache::remember($cacheKey, 86400 * 30, function () use ($path) {
            // Coba server utama (GitHub CDN: cepat, SSL terjamin, no mixed content)
            try {
                $res = Http::timeout(6)->get("{$this->primaryBase}/{$path}");
                if ($res->successful() && is_array($res->json())) {
                    return $res->json();
                }
            } catch (\Throwable $e) {
                Log::warning("Wilayah primary API fetch failed for {$path}: {$e->getMessage()}");
            }

            // Fallback ke server kedua
            try {
                $res = Http::timeout(6)->get("{$this->secondaryBase}/{$path}");
                if ($res->successful() && is_array($res->json())) {
                    return $res->json();
                }
            } catch (\Throwable $e) {
                Log::warning("Wilayah secondary API fetch failed for {$path}: {$e->getMessage()}");
            }

            return [];
        });
    }

    public function provinces(): JsonResponse
    {
        $data = $this->fetchWilayah('provinces.json');
        return response()->json($data);
    }

    public function regencies(string $provId): JsonResponse
    {
        $cleanId = preg_replace('/[^0-9]/', '', $provId);
        $data = $this->fetchWilayah("regencies/{$cleanId}.json");
        return response()->json($data);
    }

    public function districts(string $regId): JsonResponse
    {
        $cleanId = preg_replace('/[^0-9]/', '', $regId);
        $data = $this->fetchWilayah("districts/{$cleanId}.json");
        return response()->json($data);
    }

    public function villages(string $distId): JsonResponse
    {
        $cleanId = preg_replace('/[^0-9]/', '', $distId);
        $data = $this->fetchWilayah("villages/{$cleanId}.json");
        return response()->json($data);
    }
}
