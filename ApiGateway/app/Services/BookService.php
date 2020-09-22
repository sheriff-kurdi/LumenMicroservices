<?php

namespace App\Services;
use App\Traits\ConsumesExternalService;

class BookService
{
    use ConsumesExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
    }



    public function getAllBooks()
    {
        return $this->performRequest('GET', 'books');
    }

    public function createBook($data)
    {
        return $this->performRequest('POST', 'books', $data);
    }

    public function getBook($id)
    {

        return $this->performRequest('GET', "books/{$id}");
    }

    public function deleteBook($id)
    {
        return $this->performRequest('DELETE', "books/{$id}");
    }



    public function updateBook($id,$data)
    {
        //return $data;

        return $this->performRequest('PUT', "books/{$id}", $data);

    }

}
