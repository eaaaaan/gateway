<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthorService;
use App\Traits\ApiResponser;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the Book1 Microservice
     * @var AuthorService
     */
    public $authorService;
    /**
     * Create a new controller instance
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Return the list of users
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors()); 
    }
    public function add(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all(),Response::HTTP_CREATED));
    }
    /**
     * Obtains and show one user
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse($this->authorService->obtainAuthor($id));
    }
    /**
     * Update an existing author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $id));
    }
    /**
     * Remove an existing user
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        return $this->successResponse($this->authorService->deleteAuthor($id));
    }
}
