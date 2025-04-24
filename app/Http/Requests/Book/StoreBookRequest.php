<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'publisher_id' => 'nullable|exists:publishers,id',
            'published_at' => 'nullable|date',
            'description'  => 'nullable|string',
            'author_ids'   => 'nullable|array',
            'author_ids.*' => 'exists:authors,id',
        ];
    }
}
