<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class ItemEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|string|unique:items,name,' . $this->get('id') . ',id,deleted_at,NULL',
            'price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Name is required',
            'name.unique'       => 'Name has already been taken',
            'price.required'    => 'Price is required',
            'price.numeric'     => 'Price must be numeric',
        ];
    }
}
