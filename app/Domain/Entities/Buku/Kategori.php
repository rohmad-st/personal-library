<?php namespace App\Domain\Entities\Buku;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    /**
     * @var string
     */
    protected $table = 'kategori';

    /**
     * @var array
     */
    protected $fillable = [
        'nama',
        'keterangan',
    ];

    protected $primaryKey = '_id';

    /**
     * @var string
     */
    public static $tags = 'kategori';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'user_creator',
        'user_updater',
    ];

     protected $with = 'buku';

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
