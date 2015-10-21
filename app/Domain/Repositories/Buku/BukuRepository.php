<?php namespace App\Domain\Repositories\Buku;

use App\Domain\Contracts\Cacheable;
use App\Domain\Contracts\Crudable;
use App\Domain\Contracts\Paginable;
use App\Domain\Entities\Buku\Buku;
use App\Domain\Entities\Kependudukan\Keluarga;
use App\Domain\Repositories\AbstractRepository;
use Illuminate\Support\Facades\Log;

class BukuRepository extends AbstractRepository implements Crudable, Paginable
{
    /**
     * @var Cacheable
     */
    protected $cache;

    /**
     * @param Buku      $buku
     * @param Cacheable $cache
     */
    public function __construct(Buku $buku, Cacheable $cache)
    {
        $this->model = $buku;
        $this->cache = $cache;
    }

    /**
     * @param int   $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $columns = ['*'])
    {
        // set key
        $key = 'buku-find-' . $id;

        // has section and key
        if ($this->cache->has(Buku::$tags, $key)) {
            return $this->cache->get(Buku::$tags, $key);
        }

        // query to sql
        $result = parent::find($id, $columns);

        // store to cache
        $this->cache->put(Buku::$tags, $key, $result, 10);

        return $result;
    }

    /**
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(array $data)
    {
        try {
            // execute sql insert
            $result = parent::create([
                'judul'        => e($data['judul']),
                'uraian'       => (empty($data['uraian'])) ? '' : e($data['uraian']),
                'tahun'        => (empty($data['tahun'])) ? '' : e($data['tahun']),
                'tanggal_beli' => (empty($data['tanggal_beli'])) ? '' : e($data['tanggal_beli']),
                'harga'        => e($data['harga']),
                'gambar'       => e($data['gambar']),
                'penulis_id'   => $data['penulis_id'],
                'penerbit_id'  => $data['penerbit_id'],
                'kategori_id'  => $data['kategori_id'],
            ]);

            // flush cache with tags
            $this->cache->flush(Buku::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . BukuRepository::class . ' method : create | ' . $e);

            return $this->createError();
        }

    }

    /**
     * @param       $id
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update($id, array $data)
    {
        try {
            $result = parent::update($id, [
                'judul'        => e($data['judul']),
                'uraian'       => empty($data['uraian']) ? null : e($data['uraian']),
                'tahun'        => empty($data['tahun']) ? null : e($data['tahun']),
                'tanggal_beli' => empty($data['tanggal_beli']) ? null : e($data['tanggal_beli']),
                'harga'        => e($data['harga']),
                'gambar'       => e($data['gambar']),
                'penulis_id'   => e($data['penulis_id']),
                'penerbit_id'  => e($data['penerbit_id']),
                'kategori_id'  => e($data['kategori_id']),
            ]);

            // flush cache with tags
            $this->cache->flush(Buku::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . BukuRepository::class . ' method : update | ' . $e);

            return $this->createError();
        }
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete($id)
    {
        try {
            $result = parent::delete($id);

            // flush cache with tags
            $this->cache->flush(Buku::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . BukuRepository::class . ' method : delete | ' . $e);

            return $this->createError();
        }
    }

    /**
     * @param int    $limit
     * @param int    $page
     * @param array  $column
     * @param string $field
     * @param string $search
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function getByPage($limit = 10, $page = 1, array $column = ['*'], $field, $search = '')
    {
        // set key
        $key = 'buku-get-by-page-' . $page . $limit . $search;

        // has section and key
        if ($this->cache->has(Buku::$tags, $key)) {
            return $this->cache->get(Buku::$tags, $key);
        }

        // query to aql
        $result = parent::getByPageOrderBy($limit, $page, $column, 'judul', $search, '_id');

        // store to cache
        $this->cache->put(Buku::$tags, $key, $result, 10);

        return $result;
    }

}
