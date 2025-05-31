<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Check if the user is authenticated
        $validated['user_id'] = auth()->id();
        if ($validated['user_id']) {
            return true;
        }else {
            // If not authenticated, return false
            return false;
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'view_count' => 'nullable|integer|min:0',
            'image' => 'nullable|image',
            'status' => 'nullable|in:draft,published',
        ];
    }
}
