<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'=>'required|string|min:3|max:255',
            'parent_id'=>'nullable|int|exists:categories,id',
            "slug"=>["nullable","unique:categories,slug"],
            'description'=>'nullable|min:15|max:600',
            'image'=>'image|max:1048576|dimensions:min_width=100,min_height=100',
            'status'=>'in:active,archived',
        ];
    }
}
