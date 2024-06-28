<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 *
 */
class AuthorLinkResourceCollection extends ResourceCollection
{


    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($author) {
                return [
                    'id' => $author->id,
                    'name' => $author->name,
                    'country' => $author->country,
                    'surname' => $author->surname,
                    'quantity' => $author->quantity,
                    'description' => $author->description,
                    'books' => new BookResourceCollection($author->books)

                ];
            }),
        ];
    }
}
