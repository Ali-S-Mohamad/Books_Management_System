<?php

namespace App\Services;

use App\Models\Publisher;

class PublisherService
{
    public function list()
    {
        return Publisher::paginate(5);
    }

    public function store(array $data)
    {
        return Publisher::create($data);
    }

    public function update(Publisher $publisher, array $data)
    {
        $publisher->update($data);
        return $publisher;
    }

    public function delete(Publisher $publisher): void
    {
        $publisher->delete();
    }
}
