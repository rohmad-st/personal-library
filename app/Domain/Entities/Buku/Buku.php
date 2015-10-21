<?php namespace App\Domain\Entities\Buku;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    /**
     * @var string
     */
    protected $table = 'buku';

    /**
     * @var array
     */
    protected $fillable = [
        'judul',
        'uraian',
        'tahun',
        'tanggal_beli',
        'harga',
        'gambar',
        'penulis_id',
        'penerbit_id',
        'kategori_id',
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

    protected $with = 'penulis';

    /**
     * Get penulis.
     *
     * @return Penulis
     */
    public function penulis()
    {
        return $this->belongsTo('App\Domain\Entities\Buku\Penulis', 'penulis_id');
    }

//    /**
//     * Get the post's category.
//     *
//     * @return Penerbit
//     */
//    public function penerbit()
//    {
//        return $this->belongsTo('App\Penerbit', 'penerbit_id');
//    }
//    /**
//     * Get the post's category.
//     *
//     * @return Kategori
//     */
//    public function kategori()
//    {
//        return $this->belongsTo('App\Kategori', 'kategori_id');
//    }
//    public function user()
//    {
//        return $this->belongsTo('App\User');
//    }

}
