<?php

namespace App\Exports;

use App\Models\Livre;
use Maatwebsite\Excel\Concerns\FromCollection;

class LivresExport implements FromCollection
{
    public function collection()
    {
        return Livre::all();
    }
}