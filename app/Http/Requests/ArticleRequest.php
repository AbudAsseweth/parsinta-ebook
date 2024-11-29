<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            "title" => "required",
            "body" => "required",
            "category_id" => "required|exists:categories,id",
            "tags" => "array|required",
            "tags.*" => "required|exists:tags,id",
            "picture" => "nullable|mimes:jpg,png,jpeg"
        ];
    }

    public function attributes(): array
    {
        return [
            "tags.*" => 'tags',
        ];
    }
}
