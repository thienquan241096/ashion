<?php
namespace App\Helpers;

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Carbon\Carbon;

function test($price,$key)
{

    // http://api.exchangeratesapi.io/v1/latest?access_key=2d32e394177288ba86d550a4e2241fc3

    // sai
    // http://api.exchangeratesapi.io/v1/latest?access_key=2d32e394177288ba86d550a4e2241fc3
    $exchangeRates = new ExchangeRate();
    $result = $exchangeRates->convert($price, 'EUR', $key , Carbon::now());
    return $result;
}