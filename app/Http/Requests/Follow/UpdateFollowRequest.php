<?php

namespace App\Http\Requests\Follow;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateFollowRequest extends FormRequest
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
          'follower_id' => [
              'required',
              'exists:users,id',
          ],
          'following_id' => [
              'required',
              'exists:users,id',
              'different:follower_id', // Ensure the user cannot follow themselves
              Rule::unique('follows')->where(function ($query) {
                  return $query->where('follower_id', $this->follower_id)
                                ->where('following_id', $this->following_id);
              }), // Ensure the user is not already following the other user
          ]
      ];

    }

    // handle errors
    public function messages(): array
    {
        return [
            'follower_id.required' => 'Follower ID is required.',
            'follower_id.exists' => 'The follower user does not exist.',
            'following_id.required' => 'Following ID is required.',
            'following_id.different' => 'You cannot follow yourself.',
            'following_id.unique' => 'You are already following this user.',
            'following_id.exists' => 'The user you are trying to follow does not exist.',
        ];
    }
}
