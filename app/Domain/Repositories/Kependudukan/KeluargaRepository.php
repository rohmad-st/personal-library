<?php namespace App\Domain\Repositories\Kependudukan;

use App\Domain\Contracts\Cacheable;
use App\Domain\Contracts\Crudable;
use App\Domain\Contracts\Paginable;
use App\Domain\Entities\Kependudukan\Keluarga;
use App\Domain\Repositories\AbstractRepository;
use Illuminate\Support\Facades\Log;

class KeluargaRepository extends AbstractRepository implements Crudable, Paginable
{
    /**
     * @var Cacheable
     */
    protected $cache;

    /**
     * @param Keluarga  $keluarga
     * @param Cacheable $cache
     */
    public function __construct(Keluarga $keluarga, Cacheable $cache)
    {
        $this->model = $keluarga;
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
        $key = 'keluarga-find-' . $id;

        // has section and key
        if ($this->cache->has(Keluarga::$tags, $key)) {
            return $this->cache->get(Keluarga::$tags, $key);
        }

        // query to sql
        $result = parent::find($id, $columns);

        // store to cache
        $this->cache->put(Keluarga::$tags, $key, $result, 10);

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
                'nik_kk'  => e($data['nik_kk']),
                'nama_kk' => e($data['nama_kk']),
                'alamat'  => e($data['alamat']),
                'rt'      => e($data['rt']),
                'rw'      => e($data['rw']),
                'dusun'   => e($data['dusun']),
                'telepon' => (empty($data['telepon'])) ? null : e($data['telepon']),
                'status'  => (empty($data['status'])) ? '0' : e($data['status']),
            ]);

            // flush cache with tags
            $this->cache->flush(Keluarga::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . KeluargaRepository::class . ' method : create | ' . $e);

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
                'nik_kk'  => e($data['nik_kk']),
                'nama_kk' => e($data['nama_kk']),
                'alamat'  => e($data['alamat']),
                'rt'      => e($data['rt']),
                'rw'      => e($data['rw']),
                'dusun'   => e($data['dusun']),
                'telepon' => e($data['telepon']),
                'status'  => (empty($data['status'])) ? '0' : e($data['status']),
            ]);

            // flush cache with tags
            $this->cache->flush(Keluarga::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . KeluargaRepository::class . ' method : update | ' . $e);

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
            $this->cache->flush(Keluarga::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . KeluargaRepository::class . ' method : delete | ' . $e);

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
        $key = 'keluarga-get-by-page-' . $page . $limit . $search;

        // has section and key
        if ($this->cache->has(Keluarga::$tags, $key)) {
            return $this->cache->get(Keluarga::$tags, $key);
        }

        // query to aql
        $result = parent::getByPageOrderBy($limit, $page, $column, 'nik_kk', $search, 'nama_kk');

        // store to cache
        $this->cache->put(Keluarga::$tags, $key, $result, 10);

        return $result;
    }

}
