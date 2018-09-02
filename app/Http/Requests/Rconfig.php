<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class Rconfig extends FormRequest
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
            'image' => 'image|mimes:jpeg,jpg,png|max:300',
            'email' => 'required|unique:users,email,' . Auth::user()->id,
            'site_title' => 'max:100',
            'author' => 'required|max:100',
            'keyword' => 'max:300',
            'seo' => 'max:500',
            'lat' => 'max:100',
            'lng' => 'max:100',
            'fb' => 'max:100',
            'pinterest' => 'max:100',
            'twitter' => 'max:100',
            'instagram' => 'max:100',
            'gplus' => 'max:100',
            'alamat' => 'max:500',
            'telp' => 'digits_between:1,13|numeric',
        ];
    }

    public function messages() {
        return [
            //
        ];
    }
}