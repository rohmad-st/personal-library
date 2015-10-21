<?php namespace App\Domain\Entities\Kependudukan;

use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    /**
     * @var string
     */
    protected $table = 'ortu';

    /**
     * @var array
     */
    protected $fillable = [
        'nik',
        'nik_bapak',
        'nama_bapak',
        'status_bapak',
        'alamat_bapak',
        'nik_ibu',
        'nama_ibu',
        'status_ibu',
        'alamat_ibu',
        'status',
    ];

    /**
     * @var string
     */
    public static $tags = 'ortu';

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
