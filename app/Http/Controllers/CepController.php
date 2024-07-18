<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CepService;

class CepController extends Controller
{
    protected $cepService;

    public function __construct(CepService $cepService)
    {
        $this->cepService = $cepService;
    }

    public function search($ceps)
    {
        $result = $this->cepService->searchCeps($ceps);
        return response()->json($result);
    }
}
