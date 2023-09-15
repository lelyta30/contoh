<?php

namespace App\Imports;

use App\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KaryawanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $now = date('Y-m-d H:i:s');
        return new Karyawan([
            'nama'=>$row['nama'],
            'merk_meter'=>$row['merk_meter'],
            'merk_comm_device'=>$row['merk_comm_device'],
            'telp'=>$row['telp'],
            'provider'=>$row['provider'],
            'status'=>$row['status'],
            'created_at'=>$now,
            'organisasi_id'=>$row['organisasi_id']
        ]);
    }
}
