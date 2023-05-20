<?php

namespace App\Http\Requests\Appoinnt;

use Illuminate\Foundation\Http\FormRequest;

class LinkConfirmRequest extends FormRequest
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
            //
        ];
    }

    public function userId(): int
    {
        return $this->user()->id;
    }

    public function getlink(): string
    {
        return $this->input('user_permalink');
    }


}
