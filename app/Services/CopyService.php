<?php

namespace App\Services;

use App\Models\Copy;

class CopyService
{
    public function list()
    {
        return Copy::paginate(5);
    }
    public function store(array $data)
    {
        return Copy::create($data);
    }
    public function find(int $id): Copy
    {
        return Copy::findOrFail($id);
    }
    public function update(int $id, array $data)
    {
        $copy = Copy::findOrFail($id);
        $copy->update($data);
        return $copy;
    }
    public function delete(int $id): bool
    {
        return (bool) Copy::destroy($id);
    }
}
