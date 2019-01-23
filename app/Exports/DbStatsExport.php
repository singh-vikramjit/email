<?php

namespace App\Exports;

use App\DbStats;
use Maatwebsite\Excel\Concerns\FromCollection;

class DbStatsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DbStats::all();
    }
}
