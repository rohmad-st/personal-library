<?php namespace App\Domain\Entities\Buku;

use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    /**
     * @var string
     */
    protected $table = 'penulis';

    /**
     * @var array
     */
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'profil',
    ];

    protected $primaryKey = '_id';

    /**
     * @var string
     */
    public static $tags = 'buku';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

//     protected $with = 'buku';

    /**
     * Get penulis.
     *
     * @return Buku
     */
    public function buku()
    {
        return $this->hasMany('App\Domain\Entities\Buku\Buku');
    }

}
