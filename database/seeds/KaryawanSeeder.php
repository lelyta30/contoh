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
        		'nama'=>$faker->name,
	            'merk_meter'=>$faker->numerify('################'),
	            'merk_comm_device'=>$faker->numerify('##########'),
	            'telp'=>$faker->phoneNumber,
	            'provider'=>$faker->provider,
	            'ip_address'=>null,
	            'status'=>$faker->randomElement(['aktif','non aktif']),
	            'organisasi_id'=>$faker->randomElement([1,2,3])
        	];
        	array_push($data_karyawan, $data);
        }

        Karyawan::insert($data_karyawan);
    }
}
