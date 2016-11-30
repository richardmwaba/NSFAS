<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class newImprestRetirement extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'chequeNo' => 'required',
            'dateOfReturn' => 'required',
            'date' => 'required',
            'arrivedAt ' => 'required',
            'noOfNights'=>'required',
            'ratePerNight'=>'required',
            'subAmount'=>'required',



        ];
    }
}
