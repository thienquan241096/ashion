<?php

namespace App\Http\CommonModel;

use App\Models\User;

class UserCommon extends AbstractModel
{
    public function getModel() // ham sua cua con meo ke thua tu lop truu truong dong vat
    {
        $this->model = new User(); // ke thua thuoc tinh $model cua lop truu tuong
        return $this->model; // return meo, gau , ...
    }

    public function searchCart()
    {
        return $this->model->with('cart')->get();
    }

    public function checkByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
}