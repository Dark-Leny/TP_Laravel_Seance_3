<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LivresExport implements FromView
{
    protected $livres;

    public function __construct($livres)
    {
        $this->livres = $livres;
    }

    public function view(): View
    {
        return view('livres.export_excel', [
            'livres' => $this->livres
        ]);
    }
}
