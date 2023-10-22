<?php

namespace Modules\Product\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVariantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'variant.name' => ['nullable', 'string'],
            'variant.barcode' => ['nullable', 'string'],
            'variant.size' => ['nullable', 'numeric', 'min:0'],
            'variant.unit_code' => ['nullable', 'string'],
            'options.*.name' => ['nullable', 'string', 'max:32'],
            'options.*.value' => ['nullable', 'string', 'max:32'],
            'photo' => ['nullable', 'image'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('products.variants.update');
    }
}
