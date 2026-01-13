<?php

namespace App\Rules;

use App\Services\SteamLibraryService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidUserId implements ValidationRule
{
    protected $steamService;

    public function __construct()
    {
        $this->steamService = new SteamLibraryService;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->steamService->isUserIdValid($value)) {
            $fail('The :attribute is not a valid Steam User ID.');
        }
    }
}
