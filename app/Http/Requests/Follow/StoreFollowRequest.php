<?php

namespace App\Http\Requests\Follow;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFollowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // // Check if the user is authenticated
        // $validated['follower_id'] = auth()->id();
        // if ($validated['follower_id']) {
        //     return true;
        // } else {
        //     // If not authenticated, return false
        //     return false;
        // }

        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          'following_id' => [
            'required',
            'exists:users,id',
            'different:' . auth()->id(), // Ensure the user cannot follow themselves
            Rule::unique('follows')->where(function ($query) {
                return $query->where('follower_id', auth()->id());
            }), // Ensure the user is not already following the other user
          ]
        ];
    }

    // handle errors
    public function messages(): array
    {
        return [
            'following_id.different' => 'You cannot follow yourself.',
            'following_id.unique' => 'You are already following this user.',
            'following_id.exists' => 'The user you are trying to follow does not exist.',
        ];
    }
}
