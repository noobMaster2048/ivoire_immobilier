<?php


namespace App\Export;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EtatExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {

    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {

    }
}
