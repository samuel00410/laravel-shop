<?php

namespace App\Http\Requests\Controls;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user('admin');
        return $user->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'search_key' => 'required|string|regex:/^[a-zA-Z0-9_]+$/i|unique:categories,search_key,'.$this->category,
            'order_index' => 'required|integer|min:1|max:9999',
            'show_in_list' => 'required|boolean',
        ];
    }
}
