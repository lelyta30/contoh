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
            'id_pelanggan'=>$row['id_pelanggan'],
            'name'=>$row['name'],
            'address'=>$row['address'],
            'tariff'=>$row['tariff'],
            'daya'=>$row['daya'],
            'no_meter'=>$row['no_meter'],
            'merk_meter'=>$row['merk_meter'],
            'merk_meter'=>$row['type_meter'],
            'merk_meter'=>$row['no_comm_device'],
            'merk_meter'=>$row['merk_comm_device'],
            'merk_meter'=>$row['type_comm_device'],
            'merk_meter'=>$row['port'],
            'merk_meter'=>$row['phone'],
            'merk_meter'=>$row['provider'],
            'merk_meter'=>$row['ip_address'],
            'status'=>$row['status'],
            'nomor_bpjs_kesehatan'=>$row['nomor_bpjs_kesehatan'],
            'nomor_bpjs_ketenagakerjaan'=>$row['nomor_bpjs_ketenagakerjaan'],
            'created_at'=>$now,
            'organisasi_id'=>$row['organisasi_id']
        ]);
    }
}
