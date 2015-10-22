<?php namespace App\Domain\Repositories\Buku;

use App\Domain\Contracts\Cacheable;
use App\Domain\Contracts\Crudable;
use App\Domain\Contracts\Paginable;
use App\Domain\Entities\Buku\Penerbit;
use App\Domain\Repositories\AbstractRepository;
use Illuminate\Support\Facades\Log;

class PenerbitRepository extends AbstractRepository implements Crudable, Paginable
{
    /**
     * @var Cacheable
     */
    protected $cache;

    /**
     * @param Penerbit  $penerbit
     * @param Cacheable $cache
     */
    public function __construct(Penerbit $penerbit, Cacheable $cache)
    {
        $this->model = $penerbit;
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
        $key = 'penerbit-find-' . $id;

        // has section and key
        if ($this->cache->has(Penerbit::$tags, $key)) {
            return $this->cache->get(Penerbit::$tags, $key);
        }

        // query to sql
        $result = parent::find($id, $columns);

        // store to cache
        $this->cache->put(Penerbit::$tags, $key, $result, 10);

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
                'nama'        => e($data['nama']),
                'alamat'      => empty($data['alamat']) ? '' : e($data['alamat']),
                'visi'        => empty($data['visi']) ? '' : e($data['visi']),
                'misi'        => empty($data['misi']) ? '' : e($data['misi']),
                'tahun'       => empty($data['tahun']) ? '' : e($data['tahun']),
                'jumlah_buku' => empty($data['jumlah_buku']) ? 0 : e($data['jumlah_buku']),
            ]);

            // flush cache with tags
            $this->cache->flush(Penerbit::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . PenerbitRepository::class . ' method : create | ' . $e);

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
                'nama'        => e($data['nama']),
                'alamat'      => empty($data['alamat']) ? '' : e($data['alamat']),
                'visi'        => empty($data['visi']) ? '' : e($data['visi']),
                'misi'        => empty($data['misi']) ? '' : e($data['misi']),
                'tahun'       => empty($data['tahun']) ? '' : e($data['tahun']),
                'jumlah_buku' => empty($data['jumlah_buku']) ? 0 : e($data['jumlah_buku']),
            ]);

            // flush cache with tags
            $this->cache->flush(Penerbit::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . PenerbitRepository::class . ' method : update | ' . $e);

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
            $this->cache->flush(Penerbit::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . PenerbitRepository::class . ' method : delete | ' . $e);

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
        $key = 'penerbit-get-by-page-' . $page . $limit . $search;

        // has section and key
        if ($this->cache->has(Penerbit::$tags, $key)) {
            return $this->cache->get(Penerbit::$tags, $key);
        }

        // query to aql
        $result = parent::getByPageOrderBy($limit, $page, $column, 'nama', $search, '_id');

        // store to cache
        $this->cache->put(Penerbit::$tags, $key, $result, 10);

        return $result;
    }

}
