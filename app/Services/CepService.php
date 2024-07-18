<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CepService
{
    public function searchCeps($ceps)
    {
        $cepArray = explode(',', $ceps);
        $result = [];

        foreach ($cepArray as $cep) {
            $cep = preg_replace('/[^0-9]/', '', $cep);
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

            if ($response->successful()) {
                $data = $response->json();
                $data['label'] = "{$data['logradouro']}, {$data['localidade']}";
                $result[] = $data;
            } else {
                $result[] = [
                    'cep' => $cep,
                    'error' => 'CEP não encontrado ou inválido'
                ];
            }
        }

        return $result;
    }
}
