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
            'nama',
			'merk_meter',
			'merk_comm_device',
			'telp',
			'provider',
			'status',
			'organisasi_id'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($karyawan): array
    {
        return [
            $karyawan->nama,
            $karyawan->merk_meter,
            $karyawan->merk_comm_device,
            $karyawan->telp,
            $karyawan->provider,
            $karyawan->status,
            $karyawan->organisasi_id,
        ];
    }
}
