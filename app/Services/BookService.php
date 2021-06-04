<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService
{
    use ConsumesExternalService;
    /**
     * The base uri to consume the Book Service
     * @var string
     */
    public $baseUri;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    public function obtainBooks()
    {
        return $this->performRequest('GET', '/books');
    }

    public function createBook($data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    public function obtainBook($id)
    {
        return $this->performRequest('GET', "/books/{$id}");
    }

    public function editBook($data, $id)
    {
        return $this->performRequest('PUT', "/books/{$id}", $data);
    }

    public function deleteBook($id)
    {
        return $this->performRequest('DELETE', "/books/{$id}");
    }
}
