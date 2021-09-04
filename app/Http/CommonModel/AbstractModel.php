<?php

namespace App\Http\CommonModel;

abstract class AbstractModel // Lop chung dong vat
{
    protected $model; // thuoc tinh chung?

    // ham nay co the ke thua tu cac con rieng le
    abstract public function getModel(); // moi mot con dong vat co ham sua? khac nhau (ham truu tuong chua biet chi tiet cac con sua nhu nao)

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function find($id) // cac ham chung cua dong vat giong nhau: di, chay, nhay
    {
        return $this->model->find($id);
    }

    public function create(array $attribute)
    {
        return $this->model->create($attribute);
    }

    public function update($id, array $attribute)
    {
        $find = $this->find($id);
        if (!$find) {
            return false;
        }
        $find->update($attribute);
        return $find;
    }

    public function delete($id)
    {
        $find = $this->find($id);
        if (!$find) {
            return false;
        }
        $find->delete();
        return true;
    }
}