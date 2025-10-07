<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidIsbn implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isbn = str_replace([' ', '-'], '', $value);
        // Vérifier la longueur
        if (strlen($isbn) !== 13 || !ctype_digit($isbn)) {
            $fail('Le :attribute doit comporter exactement 13 chiffres.');
            return;
        }
        // Vérifier le préfixe
        if (!in_array(substr($isbn, 0, 3), ['978', '979'])) {
            $fail('Le :attribute doit commencer par 978 ou 979.');
            return;
        }
        // Calculer le checksum ISBN-13
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $digit = (int) $isbn[$i];
            $sum += ($i % 2 === 0) ? $digit : $digit * 3;
        }
        $checksum = (10 - ($sum % 10)) % 10;
        if ((int)$isbn[12] !== $checksum) {
            $fail('Le :attribute n\'est pas un ISBN-13 valide (checksum incorrect).');
            return;
        }
    }
    public function message(): string
    {
        return 'Le :attribute doit être un ISBN-13 valide.';
    }
}
