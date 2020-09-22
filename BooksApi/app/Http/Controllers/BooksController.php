<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Book;
use App\Traits\ApiResponder;
class BooksController extends BaseController
{
    use ApiResponder;
    //
    public function index()
    {
        return Book::all();
    }

    public function store(Request $request)
    {        

        $rules = [
            'title' => 'required|max:255',
            'desc' => 'required|max:255|',
            'price' => 'required|max:255|min:1',
            'author_id' => 'required|max:255|min:1',
        ];
       
            $this->validate($request, $rules);
        
      
        $book = Book::create($request->all());
        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return $this->successResponse($book);
    }

    public function update($id, Request $request)
    {
        $rules = [
            'title' => 'max:255',
            'desc' => 'max:255|',
            'price' => 'max:255|min:1',
            'author_id' => 'max:255',
        ];
       
            $this->validate($request, $rules);
     

        $book = Book::findOrFail($id);
        $book->fill($request->all());

        if ($book->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();

        return $this->successResponse($book);

    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return $this->successResponse($book);
    }
}
