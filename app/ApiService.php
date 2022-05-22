<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    function http()
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
        ])->withoutVerifying()
            ->baseUrl('https://gorest.co.in/public/v2');
    }

    function getUser() {
        return $this->http()->get('users');
    }
}
