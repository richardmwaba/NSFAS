<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class updateImprest extends Request
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
        $id = Auth::user()->accessLevelId;
        if($id == 'OT'){

            return [
                //
                'amount'=>'required|numeric',
                'purpose'=>'required',
                'budgetLine'=>'required',
            ];

        }elseif($id=='HD'){

            return [
                //
            ];

        }elseif ($id =='DN'){

            return [
                //
            'authorisedAmount'=>'required|numeric',
            ];

        }else{

            return [
                //
            ];

        }

    }
}
