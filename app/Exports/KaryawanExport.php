<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Karyawan;

class KaryawanExport implements FromQuery, WithHeadings, WithMapping
{
    protected $list_id = [];
    function __construct($list_id=[]) {
        $this->list_id = $list_id;
    }

    public function query()
    {
        $data = Karyawan::query();
        if(count($this->list_id)>0) $data = $data->whereIn('id',$this->list_id);
        return $data;
    }

	public function headings(): array
    {
        return [
            'id',
            'id_pelanggan',
            'name',
            'address',
            'tariff',
            'daya',
            'no_meter',
            'merk_meter',
            'type_meter',
            'no_comm_device',
            'merk_comm_device',
            'type_comm_device',
            'port',
            'phone',
            'provider',
            'ip_address',
            'status'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($karyawan): array
    {
        return [
            $karyawan->id_pelanggan,
            $karyawan->name,
            $karyawan->address,
            $karyawan->tariff,
            $karyawan->daya,
            $karyawan->no_meter,
            $karyawan->merk_meter,
            $karyawan->type_meter,
            $karyawan->no_comm_device,
            $karyawan->merk_comm_device,
            $karyawan->type_comm_device,
            $karyawan->port,
            $karyawan->phone,
            $karyawan->provider,
            $karyawan->ip_address,
            $karyawan->status,
        ];
    }
}
