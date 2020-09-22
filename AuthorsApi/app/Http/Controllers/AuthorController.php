<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthorController extends Controller
{
    use ApiResponder;





    public function index()
    {
        $authors = Author::all();

        return $this->successResponse($authors);
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255',
        ];

        try
        {
            $this->validate($request, $rules);
        }
        catch (ValidationException $e) 
        {
        }


        $author = Author::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }


    public function show($author)
    {
        $author = Author::findOrFail($author);

        return $this->successResponse($author);
    }


    public function update(Request $request, $author)
    {        

        $rules = [
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255',
        ];

        try {
            $this->validate($request, $rules);
        } catch (ValidationException $e) {
        }

        $author = Author::findOrFail($author);
        $author->fill($request->all());

        if ($author->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $author->save();

        return $this->successResponse($author);
    }


    public function destroy($author)
    {
        $author = Author::findOrFail($author);

        $author->delete();

        return $this->successResponse($author);
    }
}
