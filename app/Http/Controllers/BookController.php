<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookLinkResourceCollection;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 *
 */
class BookController extends Controller
{

    /**
     * @return BookLinkResourceCollection
     */
    public function index(): BookLinkResourceCollection
    {

        return new  BookLinkResourceCollection(Book::with('authors')->get());
    }

    /**
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        try {
            $book = Book::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => (float)$request->input('price'),
                'currencyCode' => $request->input('currencyCode'),
                'discount' => (float)$request->input('discount'),
                'series' => $request->input('series'),
                'chapter' => $request->input('chapter'),
                'publishingHouse' => $request->input('publishingHouse'),
                'language' => $request->input('language'),
                'ISBN' => $request->input('ISBN')
            ]);
            if ($request->input('authors.*')) {
                $author = Author::find($request->input('authors.*'));
                $book->authors()->attach($author);
            }
            return response()->json([
                "success" => true,
                "message" => "Book has been store successfully id " . $book->id . "."
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "Book has been store false "
            ], 500);
        }
    }
}
