<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorDetailssRequest extends FormRequest
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
            'md_name' => 'required',
            'md_email' => 'required',
            'md_connect' => 'required',
            'md_phone' => 'required',
            'principle_name' => 'required',
            'principle_email' => 'required',
            'principle_phone' => 'required',
            'principle_connect' => 'required',

            'finance_name' => 'required',
            'finance_email' => 'required',
            'finance_phone' => 'required',
            'finance_connect' => 'required',
        ];
    }
}
