<?php

namespace App\Exports;

use App\Models\NewsLetter;
use Hekmatinasser\Verta\Facades\Verta;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmailsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return NewsLetter::query();
    }

    public function headings(): array
    {
        return [
            'ایمیل',
            'تاریخ ثبت نام',
        ];
    }

    public function map($email): array
    {
        return [
            $email->email,

            Verta::instance($email->created_at)
        ];
    }

    public function fields(): array
    {
        return [
            'email',
            'created_at'
        ];
    }
}
