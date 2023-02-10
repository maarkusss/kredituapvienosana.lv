<?php

namespace Goodday\Goodwall\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property array $whitelist
 */
class PostWhitelist extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return config('goodwall.rules');
    }
}
