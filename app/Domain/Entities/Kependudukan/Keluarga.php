<?php namespace App\Domain\Entities\Kependudukan;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    /**
     * @var string
     */
    protected $table = 'keluarga';

    /**
     * @var array
     */
    protected $fillable = [
        'nik_kk',
        'nama_kk',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'telepon',
        'status',
    ];

    /**
     * @var string
     */
    public static $tags = 'keluarga';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
