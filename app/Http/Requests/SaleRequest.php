<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
        if ($this->getMethod() == 'POST') { //store
            $rules = [
                'purchase_at' => 'required|date|before:tomorrow',
                'delivery_days' => 'required',
                'amount' => 'required',
                'products'=>'required',
            ];
        } else { //update
            $rules = [
                'purchase_at' => 'required|date|before:tomorrow',
                'products'=>'required',
            ];
        }

        return $rules;
    }
}
