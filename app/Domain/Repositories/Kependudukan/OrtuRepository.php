<?php namespace App\Domain\Repositories\Kependudukan;

use App\Domain\Contracts\Cacheable;
use App\Domain\Contracts\Crudable;
use App\Domain\Contracts\Paginable;
use App\Domain\Entities\Kependudukan\Ortu;
use App\Domain\Entities\Kependudukan\Pribadi;
use App\Domain\Repositories\AbstractRepository;
use Illuminate\Support\Facades\Log;

class OrtuRepository extends AbstractRepository implements Crudable, Paginable
{
    /**
     * @var Cacheable
     */
    protected $cache;

    /**
     * @param Ortu      $ortu
     * @param Cacheable $cache
     */
    public function __construct(Ortu $ortu, Cacheable $cache)
    {
        $this->model = $ortu;
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
        $key = 'ortu-find-' . $id;

        // has section and key
        if ($this->cache->has(Ortu::$tags, $key)) {
            return $this->cache->get(Ortu::$tags, $key);
        }

        // query to sql
        $result = parent::find($id, $columns);

        // store to cache
        $this->cache->put(Ortu::$tags, $key, $result, 10);

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
                'nik'          => e($data['nik']),
                'nik_bapak'    => e($data['nik_bapak']),
                'nama_bapak'   => e($data['nama_bapak']),
                'status_bapak' => e($data['status_bapak']),
                'alamat_bapak' => e($data['alamat_bapak']),
                'nik_ibu'      => e($data['nik_ibu']),
                'nama_ibu'     => e($data['nama_ibu']),
                'status_ibu'   => e($data['status_ibu']),
                'alamat_ibu'   => e($data['alamat_ibu']),
                'status'       => (empty($data['status'])) ? '0' : e($data['status']),
            ]);

            // flush cache with tags
            $this->cache->flush(Ortu::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . OrtuRepository::class . ' method : create | ' . $e);

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
                'nik'          => e($data['nik']),
                'nik_bapak'    => e($data['nik_bapak']),
                'nama_bapak'   => e($data['nama_bapak']),
                'status_bapak' => e($data['status_bapak']),
                'alamat_bapak' => e($data['alamat_bapak']),
                'nik_ibu'      => e($data['nik_ibu']),
                'nama_ibu'     => e($data['nama_ibu']),
                'status_ibu'   => e($data['status_ibu']),
                'alamat_ibu'   => e($data['alamat_ibu']),
                'status'       => (empty($data['status'])) ? '0' : e($data['status']),
            ]);

            // flush cache with tags
            $this->cache->flush(Ortu::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . OrtuRepository::class . ' method : update | ' . $e);

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
            $this->cache->flush(Ortu::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . OrtuRepository::class . ' method : delete | ' . $e);

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
        $key = 'ortu-get-by-page-' . $page . $limit . $search;

        // has section and key
        if ($this->cache->has(Ortu::$tags, $key)) {
            return $this->cache->get(Ortu::$tags, $key);
        }

        // query to sql
        $result = parent::getByPageOrderBy($limit, $page, $column, 'nik', $search, 'created_at');

        // store to cache
        $this->cache->put(Ortu::$tags, $key, $result, 10);

        return $result;
    }

}
