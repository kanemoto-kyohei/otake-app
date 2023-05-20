<?php

namespace App\Http\Requests\Appoinnt;

use Illuminate\Foundation\Http\FormRequest;
use Datetime;

class SetRequest extends FormRequest
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
            //何文字以上記入など、ルールを設定する
        ];
    }


    public function setdate(): string
    {
        $settime = $_POST['settime'];
        list($date, $time) = explode('|', $settime);


        return $date;
    }

    public function settime(): string
    {
        $settime = $_POST['settime'];
        list($date, $time) = explode('|', $settime);
        return $time;
    }

    public function userId(): int
    {
        return $this->user()->id;
    }

    





}
