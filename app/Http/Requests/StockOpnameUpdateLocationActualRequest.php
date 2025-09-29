<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockOpnameUpdateLocationActualRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'location_actual_status' => ['required','in:centang,x'],
            'location_actual_keterangan' => ['nullable','string','max:1000'],
        ];
    }
}
