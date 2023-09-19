<?php

namespace App;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class RandomUser
{
    private $url = 'https://randomuser.me/api/';

    /**
     * making request to https://randomuser.me/api/
     * @return json
     */
    public function get(){
        $client = new Client();
        $response = $client->request('GET', $this->url, [
            'Accept' => 'application/json'
        ]);
        if($response->getStatusCode() >= 200 && $response->getStatusCode() < 300){
            return json_decode($response->getBody()->getContents());
        }else{
            Log::info($response, [
                'createRequest' => 'Fail',
                'url' => $this->url,
                'when' => now()
            ]);
        }
    }
}
