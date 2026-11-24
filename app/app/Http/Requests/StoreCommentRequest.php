<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Izinkan semua user (termasuk guest) mengirim komentar
    }

    public function rules(): array
    {
        return [
            'news_id' => ['required', 'exists:news,id'],
            'author_name' => ['required', 'string', 'max:100'],
            'author_email' => ['required', 'email', 'max:100'],
            'content' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.min' => 'Komentar minimal terdiri dari 10 karakter.',
            'content.max' => 'Komentar maksimal 1000 karakter.',
        ];
    }
}