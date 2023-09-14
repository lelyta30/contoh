<?php

use Illuminate\Database\Seeder;
use \App\Karyawan;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data_karyawan = [];
        
        for($i=1;$i<=200;$i++){
        	$faker = \Faker\Factory::create('id_ID');
        	$data = [
        		'id_pelanggan'=>$faker->id_pelanggan,
        		'nama'=>$faker->name,
        		'address'=>$faker->address,
        		'tariff'=>$faker->tariff,
        		'daya'=>$faker->daya,
        		'no_meter'=>$faker->no_meter,
        		'namerk_meterma'=>$faker->merk_meter,
        		'type_meter'=>$faker->type_meter,
        		'no_comm_device'=>$faker->no_comm_device,
        		'merk_comm_device'=>$faker->merk_comm_device,
        		'type_comm_device'=>$faker->type_comm_device,
        		'port'=>$faker->port,
        		'phone'=>$faker->phone,
        		'provider'=>$faker->provider,
        		'ip_address'=>$faker->ip_address,
	            'status'=>$faker->randomElement(['aktif','non aktif']),
	            'nomor_bpjs_kesehatan'=>$faker->numerify('############'),
	            'nomor_bpjs_ketenagakerjaan'=>$faker->numerify('###########'),
	            'organisasi_id'=>$faker->randomElement([1,2,3])
        	];
        	array_push($data_karyawan, $data);
        }

        Karyawan::insert($data_karyawan);
    }
}
