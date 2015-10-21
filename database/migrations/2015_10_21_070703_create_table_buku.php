<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('_id');
            $table->string('judul');
            $table->text('uraian')->nullable();
            $table->string('tahun')->nullable();
            $table->string('tanggal_beli')->nullable();
            $table->string('harga');
            $table->string('gambar');

            // relationship
            $table->unsignedInteger('penulis_id')->nullable();
            $table->foreign('penulis_id')->references('_id')->on('penulis')->onDelete('set null');
            $table->unsignedInteger('penerbit_id')->nullable();
            $table->foreign('penerbit_id')->references('_id')->on('penerbit')->onDelete('set null');
            $table->unsignedInteger('kategori_id')->nullable();
            $table->foreign('kategori_id')->references('_id')->on('kategori')->onDelete('set null');

            $table->string('user_id');
            $table->string('user_creator')->nullable()->default(null);
            $table->string('user_updater')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('buku');
    }
}
