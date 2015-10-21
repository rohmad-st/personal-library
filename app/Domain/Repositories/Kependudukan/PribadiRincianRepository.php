<?php namespace App\Domain\Repositories\Kependudukan;

use App\Domain\Contracts\Cacheable;
use App\Domain\Contracts\Crudable;
use App\Domain\Contracts\Paginable;
use App\Domain\Entities\Kependudukan\PribadiRincian;
use App\Domain\Repositories\AbstractRepository;
use Illuminate\Support\Facades\Log;

class PribadiRincianRepository extends AbstractRepository implements Crudable, Paginable
{
    /**
     * @var Cacheable
     */
    protected $cache;

    /**
     * @param PribadiRincian $pribadi
     * @param Cacheable      $cache
     */
    public function __construct(PribadiRincian $pribadi, Cacheable $cache)
    {
        $this->model = $pribadi;
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
        $key = 'pribadi-rincian-find-' . $id;

        // has section and key
        if ($this->cache->has(PribadiRincian::$tags, $key)) {
            return $this->cache->get(PribadiRincian::$tags, $key);
        }

        // query to sql
        $result = parent::find($id, $columns);

        // store to cache
        $this->cache->put(PribadiRincian::$tags, $key, $result, 10);

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
                'nik'            => e($data['nik']),
                'kelainan_fisik' => (empty($data['kelainan_fisik'])) ? null : e($data['kelainan_fisik']),
                'cacat_fisik'    => (empty($data['cacat_fisik'])) ? null : e($data['cacat_fisik']),
                'warga_negara'   => e($data['warga_negara']),
                'website'        => (empty($data['website'])) ? null : e($data['website']),
                'email'          => (empty($data['email'])) ? null : e($data['email']),
                'telp'           => (empty($data['telp'])) ? null : e($data['telp']),
                'status'         => (empty($data['status'])) ? '0' : e($data['status']),
            ]);

            // flush cache with tags
            $this->cache->flush(PribadiRincian::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . PribadiRincianRepository::class . ' method : create | ' . $e);

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
                'nik'            => e($data['nik']),
                'kelainan_fisik' => (empty($data['kelainan_fisik'])) ? null : e($data['kelainan_fisik']),
                'cacat_fisik'    => (empty($data['cacat_fisik'])) ? null : e($data['cacat_fisik']),
                'warga_negara'   => e($data['warga_negara']),
                'website'        => (empty($data['website'])) ? null : e($data['website']),
                'email'          => (empty($data['email'])) ? null : e($data['email']),
                'telp'           => (empty($data['telp'])) ? null : e($data['telp']),
                'status'         => (empty($data['status'])) ? '0' : e($data['status']),
            ]);

            // flush cache with tags
            $this->cache->flush(PribadiRincian::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . PribadiRincianRepository::class . ' method : update | ' . $e);

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
            $this->cache->flush(PribadiRincian::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . PribadiRincianRepository::class . ' method : delete | ' . $e);

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
        $key = 'pribadi-rincian-get-by-page-' . $page . $limit . $search;

        // has section and key
        if ($this->cache->has(PribadiRincian::$tags, $key)) {
            return $this->cache->get(PribadiRincian::$tags, $key);
        }

        // query to sql
        $result = parent::getByPageOrderBy($limit, $page, $column, 'nik', $search, 'created_at');

        // store to cache
        $this->cache->put(PribadiRincian::$tags, $key, $result, 10);

        return $result;
    }

}
