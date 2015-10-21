<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenerbit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerbit', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('_id');
            // $table->string('_id');
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('visi')->nullable();
            $table->string('misi')->nullable();

            // tahun berdiri
            $table->string('tahun')->nullable();
            $table->double('jumlah_buku')->default(0);

            $table->string('user_id');
            $table->string('user_creator')->nullable()->default(null);
            $table->string('user_updater')->nullable()->default(null);
            // $table->primary('_id');
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('penerbit');
    }
}
