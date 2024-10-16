<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class LaporanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'waktu' => function ($attribute, $value, $fail) {
                $now = Carbon::now()->format('j F Y');

                $nowPlusOneDay = Carbon::now()->addDay()->format('j F Y');

                $singleValue = '/^\d{1,2}\s(January|February|March|April|May|June|July|August|September|October|November|December)\s\d{4}$/';
                $rangeValue = '/^\d{1,2}\s(January|February|March|April|May|June|July|August|September|October|November|December)\s\d{4}\ssampai\s\d{1,2}\s(January|February|March|April|May|June|July|August|September|October|November|December)\s\d{4}$/';

                if (!preg_match($singleValue, $value) && !preg_match($rangeValue, $value)) {
                    $fail("Format periode harus berupa {$now} atau {$now} sampai {$nowPlusOneDay}.");
                }
            },
            'angkatan' => ['integer', 'digits:4'],
        ];
    }

    public function messages()
    {
        return [
            'angkatan.integer' => 'Format angkatan harus berupa tahun.',
            'angkatan.digits' => 'Sepertinya tahun sekarang berupa 4 digit.',
        ];
    }
}
