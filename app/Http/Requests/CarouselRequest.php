<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarouselRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'page' => ['required', 'string', 'max:50'],
            'position' => ['required', 'string', 'max:50'],
            'interval' => ['required', 'integer', 'min:1', 'max:100'],
            'fade' => ['boolean'],
            'autoplay' => ['boolean'],
            'indicators' => ['boolean'],
            'controls' => ['boolean']
        ];
    }
}
