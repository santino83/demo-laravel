<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarouselImageRequest extends FormRequest
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
            'interval' => ['required', 'integer', 'min:0', 'max:100'],
            'position' => ['required', 'integer', 'min:1'],
            'image' => ['required', 'mimes:png,jpg,jpeg', 'max:5120'],
            'title' => ['max:50'],
            'description' => ['max:150']
        ];
    }
}
