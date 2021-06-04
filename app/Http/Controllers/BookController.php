<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\BookService;
use App\Services\AuthorService;
use App\Traits\ApiResponser;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the Book Microservice
     * @var BookService
     */
    public $bookService;
    public $authorService;
    /**
     * Create a new controller instance
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Return the list of users
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks()); 
    }
    public function add(Request $request)
    {
        $this->authorService->obtainAuthor($request->authorid);
        return $this->successResponse($this->bookService->createBook($request->all(),Response::HTTP_CREATED));
    }
    /**
     * Obtains and show one user
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse($this->bookService->obtainBook($id));
    }
    /**
     * Update an existing author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorService->obtainAuthor($request->authorid);
        return $this->successResponse($this->bookService->editBook($request->all(), $id));
    }
    /**
     * Remove an existing user
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        return $this->successResponse($this->bookService->deleteBook($id));
    }
}
