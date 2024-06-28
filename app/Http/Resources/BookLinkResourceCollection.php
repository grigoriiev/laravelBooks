<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 *
 */
class BookLinkResourceCollection extends ResourceCollection
{


    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function ($book) {

                return [
                    'id' => $book->id,
                    'name' => $book->name,
                    'price' => $book->price,
                    'currencyCode' => $book->currencyCode,
                    'discount' => $book->discount,
                    'description' => $book->description,
                    'series' => $book->series,
                    'chapter' => $book->chapter,
                    'publishingHouse' => $book->publishingHouse,
                    'language' => $book->language,
                    'ISBN' => $book->ISBN,
                    'authors' => new AuthorResourceCollection($book->authors)];
            }),
        ];
    }


}
