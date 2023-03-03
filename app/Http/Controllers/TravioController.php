<?php

namespace App\Http\Controllers;

use App\Service\TravioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TravioController extends Controller
{

    public function __construct(private TravioService $travioService){
    }

    public function searchHotels(Request $request): JsonResponse
    {
        $content = $request->json()->all();
        $fromDate = $content['from'];
        $toDate = $content['to'];

        $response = $this->travioService->searchHotels($fromDate, $toDate);

        return response()->json($response->json(), $response->status());
    }

}
