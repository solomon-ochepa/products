<?php

namespace Modules\Product\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product.name' => ['required', 'string', 'min:3', 'max:64'],
            'product.description' => ['nullable', 'string', 'min:3'],
            'product.brand_id' => ['nullable', 'uuid', 'min:3'],
            'product.manufacturer_id' => ['nullable', 'uuid', 'min:3'],
            //
            'photos.*' => ['nullable', 'image'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('products.create');
    }
}
