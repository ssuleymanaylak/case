<?php

namespace App\Repositories;

use App\Models\Yukatechtest;

class YukatechtestRepository
{
    public function create(array $data)
    {
        return Yukatechtest::create($data);
    }

    public function getAll()
    {
        return Yukatechtest::all();
    }

    public function getById($id)
    {
        return Yukatechtest::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $location = Yukatechtest::findOrFail($id);
        $location->update($data);
        return $location;
    }
}
