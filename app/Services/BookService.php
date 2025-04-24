<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function list()
    {
        return Book::with('authors')->paginate(5);
    }
    public function store(array $data)
    {
        $book = Book::create($data);
        if (!empty($data['author_ids'])) {
            $book->authors()->sync($data['author_ids']);
        }
        return $book->load('authors');
    }
    public function find(int $id): Book
    {
        return Book::with('authors')->findOrFail($id);
    }
    public function update(int $id, array $data)
    {
        $book = $this->find($id);
        $book->update($data);
        if (isset($data['author_ids'])) {
            $book->authors()->sync($data['author_ids']);
        }
        return $book->load('authors');
    }
    public function delete(int $id): bool
    {
        return (bool) Book::destroy($id);
    }
}
