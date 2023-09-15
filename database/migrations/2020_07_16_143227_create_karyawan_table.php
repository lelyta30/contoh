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
            $table->string('nama')->nullable(false);
            $table->string('merk_meter',50)->nullable();
            $table->string('merk_comm_device',50)->nullable(false)->unique();
            $table->string('telp',20)->nullable();
            $table->string('provider',100)->nullable();
            $table->string('ip_address')->nullable();
            $table->enum('status',['aktif','non aktif'])->default('aktif');
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
