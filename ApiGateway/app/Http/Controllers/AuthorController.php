<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\AuthorService;
use App\Traits\ApiResponder;
use Illuminate\Http\Response;

class AuthorController extends Controller
{

    use ApiResponder;

    /**
     * The service to consume the authors microservice
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @param AuthorService $authorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }




    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors());

    }


    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all(), Response::HTTP_CREATED));  
      }


    public function show($author)
    {
        return $this->successResponse($this->authorService->obtainAuthor($author));
    }


    public function update(Request $request, $author)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }


    public function destroy($author)
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }
}
