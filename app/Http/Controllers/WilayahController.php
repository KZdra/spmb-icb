<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WilayahController extends Controller
{
    private string $primaryBase = 'https://www.emsifa.com/api-wilayah-indonesia/v2';

    /**
     * Helper untuk fetch data wilayah v2 dengan cache 30 hari
     */
    private function fetchWilayah(string $path): array
    {
        $cacheKey = 'wilayah_v2_' . md5($path);
        return Cache::remember($cacheKey, 86400 * 30, function () use ($path) {
            try {
                $res = Http::timeout(8)->get("{$this->primaryBase}/{$path}");
                if ($res->successful()) {
                    $json = $res->json();
                    if (isset($json['data']) && is_array($json['data'])) {
                        return $json['data'];
                    }
                    if (is_array($json)) {
                        return $json;
                    }
                }
            } catch (\Throwable $e) {
                Log::warning("Wilayah v2 API fetch failed for {$path}: {$e->getMessage()}");
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
        $cleanId = preg_replace('/[^0-9.]/', '', $provId);
        $data = $this->fetchWilayah("regencies/{$cleanId}.json");
        return response()->json($data);
    }

    public function districts(string $regId): JsonResponse
    {
        $cleanId = preg_replace('/[^0-9.]/', '', $regId);
        $data = $this->fetchWilayah("districts/{$cleanId}.json");
        return response()->json($data);
    }

    public function villages(string $distId): JsonResponse
    {
        $cleanId = preg_replace('/[^0-9.]/', '', $distId);
        $data = $this->fetchWilayah("villages/{$cleanId}.json");
        return response()->json($data);
    }
}

