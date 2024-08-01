<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $contactId = $this->route('contact');
        return [
            'name'=>'required',
            'email'=>'required|email|unique:contacts,email,'. ($contactId ? $contactId->id : null),
            'telefone'=>'required|min:11|max:11'
        ];
    }

}
