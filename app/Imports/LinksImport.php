<?php

namespace App\Imports;

use App\Models\Links;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMappedCells;


class LinksImport implements WithMappedCells, ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function mapping(): array
    {
        return [
            'name'  => 'A1',
            'title' => 'B1',
        ];
    }


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Links([
            'name'   => $row[0],
            'title'  => $row[1],
            'url'    => $row[2],
            'email'  => $row[3],
            'phone'  => $row[4],
        ]);
    }

    public function headingRow(): int
    {
        return 6;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
