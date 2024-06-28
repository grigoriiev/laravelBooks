<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|string',
            'currencyCode' => 'required|string',
            'discount' => 'required|string',
            'series' => 'required|string',
            'chapter' => 'required|string',
            'publishingHouse' => 'required|string',
            'language' => 'required|string',
            'ISBN' => 'required|string',
        ];

    }
}
