<?php


namespace App\Export;


use App\Client;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return Client::all();
    }
}
