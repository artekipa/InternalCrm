<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNominatedsRequest extends FormRequest
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
            
            'programs_id.*' => 'exists:programs,id',
            'project_id.*' => 'exists:projects,id',
            'award_id.*' => 'exists:awards,id',
            'year_id' => 'required',
            'user_id' => 'required',
            'user_id.*' => 'exists:users,id',
            'materialdates' => 'nullable|date_format:'.config('app.date_format'),
            'docsdate' => 'nullable|date_format:'.config('app.date_format'),
            'sitenumber' => 'max:2147483647|nullable|numeric',
            'cpemail' => 'email',
            'cpphone' => 'max:2147483647|nullable|numeric',
            'presentation_site_no' => 'max:2147483647|nullable|numeric',
            'organizations_id.*' => 'exists:organizations,id',
            'eventpersonno' => 'max:2147483647|nullable|numeric',
        ];
    }
}
