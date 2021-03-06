<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TransactionRequest extends FormRequest
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
            'description' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required|in:Income,Expense',
            'due_at' => 'required|date',
            'category_id' => 'required|numeric|exists:categories,id',
            'account_id' => 'required|numeric|exists:bank_accounts,id',
            'payed' => 'required|boolean',

            //Repeat
            'repeat' => 'nullable',
            'repeatTimes' => 'required_if:repeat,true|numeric',

            //Recurring
            'recurring' => 'nullable',

            //period
            'period' => 'required_if:repeat,true|required_if:recurring,true|in:Daily,Weekly,Biweekly,Monthly,Quarterly,Semiannually,Annually',
        ];
    }

    public function messages()
    {
        return [
            'repeatTimes.required_if' => 'The repeat times field is required when repeat is selected.',
            'period.required_if' => 'The period between each transaction must be informed.',
        ];
    }
    
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors], 422));
    }
}
