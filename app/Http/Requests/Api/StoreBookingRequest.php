<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'business' => ['nullable', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'phone'    => ['nullable', 'string', 'max:50'],
            'service'  => ['required', 'string', 'in:Local SEO,Google Business Profile,Google & Meta Ads,Social Media,Web Design,Content & SEO,Not sure yet — help me decide'],
            'date'     => ['nullable', 'date', 'after_or_equal:today'],
            'time'     => ['nullable', 'string', 'in:morning,afternoon,evening'],
            'message'  => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Please enter your name.',
            'email.required'   => 'Please enter your email address.',
            'email.email'      => 'That email address doesn\'t look right.',
            'service.required' => 'Please choose a service.',
            'service.in'       => 'Please select a valid service.',
            'date.after_or_equal' => 'The preferred date must be today or a future date.',
        ];
    }
}
