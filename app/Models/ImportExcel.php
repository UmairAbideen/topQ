<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportExcel implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            try {
                User::create([
                    'username' => $row['username'],
                    'email' => $row['email'],
                    'password' => Hash::make($row['password']),
                    'role' => $row['role'],
                    'department' => $row['department'],
                    'designation' => $row['designation'],
                    'approval' => $row['approval'],
                    'status' => $row['status'],
                ]);
            } catch (\Exception $e) {
                logger("❌ Failed on row $index: " . $e->getMessage(), $row->toArray());
            }
        }
    }
}
