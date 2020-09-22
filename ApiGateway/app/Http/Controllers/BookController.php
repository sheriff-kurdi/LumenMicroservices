<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request;

use App\Services\BookService;
use App\Traits\ApiResponder;
use Illuminate\Http\Response;

class BookController extends Controller
{

    use ApiResponder;

    /**
     * The service to consume the ids microservice
     * @var bookService
     */
    public $bookService;
    public $authorService;


    /**
     * Create a new controller instance.
     *
     * @param idService $idService
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;

    }




    public function index()
    {
        return $this->successResponse($this->bookService->getAllBooks());

    }


    public function store(Request $request)
    {
        return $this->authorService->obtainAuthor($request->author_id);
        return $request->author_id;
        return $this->successResponse($this->bookService->createBook($request->all(), Response::HTTP_CREATED));  
    }


    public function show($id)
    {
        return $this->successResponse($this->bookService->getBook($id));
    }


    public function update(Request $request, $id)
    {

        return $this->successResponse($this->bookService->updateBook($request->all(), $id));
    }


    public function destroy($id)
    {
        return $this->successResponse($this->bookService->deleteBook($id));
    }
}
