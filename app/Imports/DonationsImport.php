<?php

namespace App\Imports;

use App\Models\Donation;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DonationsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function model(array $row)
    {

        Log::info('Importing row: ' . json_encode($row));

        return new Donation([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number'],
            'address' => $row['address'],
            'donation_date' => $row['donation_date'],
            'amount' => $row['amount'],
        ]);
    }
    public function chunkSize(): int
    {
        return 100;
    }
}
