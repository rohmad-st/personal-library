<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'provinsi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_provinsi',
        'provinsi',
        'pbb_prov_kode',
        'arsip_prov_kode',
        'kodepos_prov_kode',
        'ramil_prov_kode',
    ];

}
