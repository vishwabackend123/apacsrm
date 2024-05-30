<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorsRequest extends FormRequest
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
            'vendor_code' => 'required',
            'analysis' => 'required',
            'vendor_name' => 'required',
            'vendor_website' => 'required',
            'vendor_country' => 'required',
            'vendor_city' => 'required',
        ];
    }
}
