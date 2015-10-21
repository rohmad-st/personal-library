<?php namespace App\Domain\Repositories\Kependudukan;

use App\Domain\Contracts\Cacheable;
use App\Domain\Contracts\Crudable;
use App\Domain\Contracts\Paginable;
use App\Domain\Entities\Kependudukan\Pribadi;
use App\Domain\Repositories\AbstractRepository;
use Illuminate\Support\Facades\Log;

class PribadiRepository extends AbstractRepository implements Crudable, Paginable
{
    /**
     * @var Cacheable
     */
    protected $cache;

    /**
     * @param Pribadi   $pribadi
     * @param Cacheable $cache
     */
    public function __construct(Pribadi $pribadi, Cacheable $cache)
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
        $key = 'pribadi-find-' . $id;

        // has section and key
        if ($this->cache->has(Pribadi::$tags, $key)) {
            return $this->cache->get(Pribadi::$tags, $key);
        }

        // query to sql
        $result = parent::find($id, $columns);

        // store to cache
        $this->cache->put(Pribadi::$tags, $key, $result, 10);

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
                'keluarga_id'     => e($data['keluarga_id']),
                'nik'             => e($data['nik']),
                'title_depan'     => (empty($data['title_depan'])) ? null : e($data['title_depan']),
                'title_belakang'  => (empty($data['title_belakang'])) ? null : e($data['title_belakang']),
                'nama'            => e($data['nama']),
                'kelamin'         => e($data['kelamin']),
                'tempat_lahir'    => e($data['tempat_lahir']),
                'tanggal_lahir'   => e($data['tanggal_lahir']),
                'golongan_darah'  => (empty($data['golongan_darah'])) ? null : e($data['golongan_darah']),
                'agama'           => e($data['agama']),
                'status_kawin'    => e($data['status_kawin']),
                'status_keluarga' => e($data['status_keluarga']),
                'pendidikan'      => (empty($data['pendidikan'])) ? null : e($data['pendidikan']),
                'pekerjaan'       => (empty($data['pekerjaan'])) ? null : e($data['pekerjaan']),
                'status'          => (empty($data['status'])) ? '0' : e($data['status']),
            ]);

            // flush cache with tags
            $this->cache->flush(Pribadi::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . PribadiRepository::class . ' method : create | ' . $e);

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
                'keluarga_id'     => e($data['keluarga_id']),
                'nik'             => e($data['nik']),
                'title_depan'     => (empty($data['title_depan'])) ? null : e($data['title_depan']),
                'title_belakang'  => (empty($data['title_belakang'])) ? null : e($data['title_belakang']),
                'nama'            => e($data['nama']),
                'kelamin'         => e($data['kelamin']),
                'tempat_lahir'    => e($data['tempat_lahir']),
                'tanggal_lahir'   => e($data['tanggal_lahir']),
                'golongan_darah'  => (empty($data['golongan_darah'])) ? null : e($data['golongan_darah']),
                'agama'           => e($data['agama']),
                'status_kawin'    => e($data['status_kawin']),
                'status_keluarga' => e($data['status_keluarga']),
                'pendidikan'      => (empty($data['pendidikan'])) ? null : e($data['pendidikan']),
                'pekerjaan'       => (empty($data['pekerjaan'])) ? null : e($data['pekerjaan']),
                'status'          => (empty($data['status'])) ? '0' : e($data['status']),
            ]);

            // flush cache with tags
            $this->cache->flush(Pribadi::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . PribadiRepository::class . ' method : update | ' . $e);

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
            $this->cache->flush(Pribadi::$tags);

            return $result;

        } catch (\Exception $e) {
            // store errors to log
            Log::error('class : ' . PribadiRepository::class . ' method : delete | ' . $e);

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
        $key = 'pribadi-get-by-page-' . $page . $limit . $search;

        // has section and key
        if ($this->cache->has(Pribadi::$tags, $key)) {
            return $this->cache->get(Pribadi::$tags, $key);
        }

        // query to sql
        $result = parent::getByPageOrderBy($limit, $page, $column, 'nik', $search, 'nama');

        // store to cache
        $this->cache->put(Pribadi::$tags, $key, $result, 10);

        return $result;
    }

}
