<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterStatisticsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'start' => ['nullable', 'required_with:end', 'date'],
            'end' => ['nullable', 'required_with:start', 'date', 'after_or_equal:start'],
        ];
    }
}
