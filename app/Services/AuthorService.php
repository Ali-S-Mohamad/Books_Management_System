<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    public function list()
    {
        return Author::paginate(5);
    }
    public function store(array $data)
    {
        return Author::create($data);
    }
    public function find(int $id)
    {
        return Author::findOrFail($id);
    }
    public function update(int $id, array $data)
    {
        $author = $this->find($id);
        $author->update($data);
        return $author;
    }
    public function delete(int $id)
    {
        return Author::destroy($id);
    }
}
