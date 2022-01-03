<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\CommonModel\UserCommon;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Carbon\Carbon;

use function App\Helpers\test;

class UpdateUserController extends Controller
{
    private $user;

    public function __construct(UserCommon $user) // Khoiwr tao doi tuong o tham so cua ham contruct
    {
        // $user = new User();
        $this->user = $user;
    }

    public function update(Request $request)
    {
        $findByName = $this->user->checkByName('duongg');
        if ($findByName)
            dump($this->user->checkByName('duong'));
        else dump("khong co duong");
        // $id = 1;
        // $update = $this->user->update($id, [
        //     'name' => 'Duong'
        // ]);
        // if ($update) {
        //     return $update;
        // }
    }

    public function getAll()
    {
        dd($this->user->searchCart());
    }

    public function tesstChangecurrency()
    {
        // dd(test(500,"VND"));

        $exchangeRates = new ExchangeRate();
        $result = $exchangeRates->convert(500, 'EUR', 'VND' , Carbon::now());
        dd($result);
        // $result = $exchangeRates->convert(100, 'GBP', 'EUR', Carbon::now());
    }
}