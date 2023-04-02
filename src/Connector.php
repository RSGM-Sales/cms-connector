<?php

namespace RSGMSales\Connector;

use Illuminate\Support\Facades\Http;

class Connector
{

    public function quote() {
        $response = Http::get('https://inspiration.goprogram.ai/');
        return $response['quote'] . ' -' . $response['author'];
    }

}
