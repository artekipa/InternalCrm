<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCatawardsRequest extends FormRequest
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
            'name' => 'required',
            'nominateds.*.sitenumber' => 'max:2147483647|nullable|numeric',
            'nominateds.*.cpemail' => 'email',
            'nominateds.*.cpphone' => 'max:2147483647|nullable|numeric',
            'nominateds.*.presentation_site_no' => 'max:2147483647|nullable|numeric',
            'nominateds.*.eventpersonno' => 'max:2147483647|nullable|numeric',
        ];
    }
}
