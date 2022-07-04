<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    // api key raja ongkir
    protected $API_KEY = 'cbf9d0f07b09d4b330d7b2021383aa20';

    // get provinsi
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces = $response['rajaongkir']['results'];

        return response()->json([
            'success' => true,
            'message' => 'Get All Provinces',
            'data' => $provinces
        ]);
    }

    // get cities
    public function getCities($id)
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/city?&province=' . $id . '');

        $cities = $response['rajaongkir']['results'];

        return response()->json([
            'success' => true,
            'message' => 'Get City By ID Provinces : ' . $id,
            'data' => $cities
        ]);
    }

    // cek ongkir
    public function checkOngkir(Request $request)
    {
        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier
        ]);

        $ongkir = $response['rajaongkir']['results'];

        return response()->json([
            'success' => true,
            'message' => 'Result Cost Ongkir',
            'data' => $ongkir
        ]);
    }
}
