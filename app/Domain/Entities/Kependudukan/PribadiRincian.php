<?php namespace App\Domain\Entities\Kependudukan;

use Illuminate\Database\Eloquent\Model;

class PribadiRincian extends Model
{
    /**
     * @var string
     */
    protected $table = 'pribadi_rincian';

    /**
     * @var array
     */
    protected $fillable = [
        'nik',
        'kelainan_fisik',
        'cacat_fisik',
        'warga_negara',
        'website',
        'email',
        'telp',
        'status',
    ];

    /**
     * @var string
     */
    public static $tags = 'pribadi-rincian';

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
