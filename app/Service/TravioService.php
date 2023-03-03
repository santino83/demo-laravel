<?php

namespace App\Service;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class TravioService
{

    private string $travioId;
    private string $travioKey;

    private string $travioUrl = 'https://api.travio.it';

    private bool $authenticated = false;
    private string $travioToken;


    public function authenticate()
    {

        $response = Http::post($this->travioUrl . '/auth', [
            'id' => $this->travioId,
            'key' => $this->travioKey
        ]);

        if ($response->status() !== 200) throw new \Exception("Cannot authenticate");

        $this->travioToken = $response->json('token');
        $this->authenticated = (bool)$this->travioToken;
    }

    /**
     * TODO: DEMO METHOD TO SEARCH HOTELS. REFACTORY
     *
     * @param string $from
     * @param string $to
     * @return Response
     */
    public function searchHotels(string $from, string $to): Response
    {
        $this->ensureAuthenticated();

        $request = json_encode([
            'type' => 'hotels',
            'from' => $from,
            'to' => $to,
            'geo' => [13],
            'occupancy' => [
                ['adults' => 2, 'children' => []]
            ]
        ]);

        $response = Http::withToken($this->travioToken)->withBody($request)->post($this->travioUrl . '/booking/search');

        return new Response($response);
    }

    /**
     * @param string $travioId
     */
    public function setTravioId(?string $travioId): void
    {
        $this->travioId = $travioId;
    }

    /**
     * @param string $travioKey
     */
    public function setTravioKey(?string $travioKey): void
    {
        $this->travioKey = $travioKey;
    }

    /**
     * @param string $travioUrl
     */
    public function setTravioUrl(?string $travioUrl): void
    {
        $this->travioUrl = $travioUrl;
    }

    /**
     * @return bool
     */
    public function isAuthenticated(): ?bool
    {
        return $this->authenticated;
    }

    private function ensureAuthenticated(): void
    {
        if (!$this->isAuthenticated()) $this->authenticate();
    }

}
