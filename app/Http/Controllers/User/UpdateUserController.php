<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\CommonModel\UserCommon;

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
}