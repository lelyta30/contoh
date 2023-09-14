<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('id_pelanggan')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('address')->nullable(false);
            $table->string('tariff')->nullable(false);
            $table->string('daya')->nullable(false);
            $table->string('no_meter')->nullable(false);
            $table->string('merk_meter')->nullable(false);
            $table->string('type_meter')->nullable(false);
            $table->string('no_comm_device')->nullable(false);
            $table->string('merk_comm_device')->nullable(false);
            $table->string('type_comm_device')->nullable(false);
            $table->string('port')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->string('provider')->nullable(false);
            $table->string('ip_address')->nullable(false);
            $table->enum('status',['aktif','non aktif'])->default('aktif');
            $table->string('nomor_bpjs_kesehatan',20)->nullable();
            $table->string('nomor_bpjs_ketenagakerjaan',20)->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
}
