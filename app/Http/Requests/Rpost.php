<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Rpost extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'title' => 'required|max:100',
                        'description' => 'required',
                        'keyword' => 'max:255',
                        'image' => 'image|mimes:jpeg,jpg,png|max:500'
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'title' => 'required|max:100',
                        'description' => 'required',
                        'keyword' => 'max:255',
                        'image' => 'image|mimes:jpeg,jpg,png|max:500'
                    ];
                }
            default:
                break;
        }
    }

    public function messages() {
        return [
            //
        ];
    }
}