<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorLinkResourceCollection;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 *
 */
class AuthorController extends Controller
{
    /**
     * @return AuthorLinkResourceCollection
     */
    public function index(): AuthorLinkResourceCollection
    {

        return new AuthorLinkResourceCollection(Author::with('books')->get());
    }

    /**
     * @param StoreAuthorRequest $request
     * @return JsonResponse
     */
    public function store(StoreAuthorRequest $request): JsonResponse
    {

        try {
            $author = Author::create([
                'country' => $request->input('country'),
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'quantity' => (int)$request->input('quantity'),
                'description' => $request->input('description'),
            ]);
            if ($request->input('books.*')) {
                $books = Book::find($request->input('books.*'));
                $author->books()->attach($books);
            }

            return response()->json([
                "success" => true,
                "message" => "Author has been store successfully id " . $author->id . "."
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "Author has been store false "
            ], 500);
        }
    }
}
