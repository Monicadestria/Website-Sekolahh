<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'theme_color_primary' => 'required',
            'theme_color_secondary' => 'required',
            'theme_color_body' => 'required',
            'font_color_primary' => 'required',
            'font_color_secondary' => 'required',
        ];


        return $rules;
    }
}
