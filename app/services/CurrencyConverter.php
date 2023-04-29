<?php


namespace app\services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    private $apiKey;
    protected $baseUrl = 'https://free.currconv.com/api/v7';
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
    public function convert(string $form, string $to, float $amount = 1): float
    {
        $q = "{$form}_{$to}";
        $response = Http::baseUrl($this->baseUrl)
            ->get('/convert', [
                'q' => $q,
                'compact' => 'y',
                'apiKey' => $this->apiKey,
            ]);

        $result = $response->json();

        return $result[$q]['val'] * $amount;
    }
}
