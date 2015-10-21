<?php namespace App\Domain\Repositories;

use App\Domain\Contracts\Repository as RepositoryContract;

/**
 * Class AbstractRepository
 *
 * @package app\Domain\Repository
 */
abstract class AbstractRepository implements RepositoryContract
{
    /**
     * The model instance
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The model relations
     *
     * @var array
     */
    protected $with = [];

    /**
     * Set the array of items to eager load
     *
     * @param  array $with
     *
     * @return self
     */
    public function load(array $with)
    {
        $this->with = $with;

        return $this;
    }

    /**
     * Make a new instance of the entity to query on
     */
    public function make()
    {
        return $this->model->with($this->with);
    }

    /**
     * Retrieve all entities
     *
     * @param  array $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $columns = ['*'])
    {
        return $this->make()->get($columns);
    }

    /**
     * Find a single entity
     *
     * @param  int   $id
     * @param  array $columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $columns = ['*'])
    {
        return $this->make()->find($id, $columns);
    }

    /**
     * @param       $key
     * @param       $value
     * @param int   $limit
     * @param int   $page
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function likeSearch($key, $value, $limit = 10, $page = 1, array $columns = ['*'])
    {
        return $this->make()->where($key, 'like', '%' . $value . '%')->paginate($limit, $columns);
    }

    /**
     * Create a new entity
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(array $data)
    {
        $q = $this->model->create($data);

        if (!$q) {
            return $this->createError();
        }

        return $this->createSuccess();
    }

    /**
     * Update an existing entity
     *
     * @param       $id
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update($id, array $data)
    {
        $q = $this->find($id)->fill($data)->save();

        if (!$q) {
            return $this->updateError();
        }

        return $this->updateSuccess();

    }

    /**
     * Delete an existing entity
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function delete($id)
    {
        $q = $this->find($id);

        if (!$q) {
            return $this->deleteError();
        }
        $q->delete();

        return $this->deleteSuccess();
    }

    /**
     * Get Results by Page
     *
     * @param  int    $limit
     * @param  int    $page
     * @param  array  $columns
     * @param  string $key
     * @param  string $value
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function getByPage($limit = 10, $page = 1, array $columns = ['*'], $key, $value = '')
    {
        return $this->make()->where($key, 'like', '%' . $value . '%')->paginate($limit, $columns);
    }

    /**
     * Get result for kode_rekening
     *
     * @param int    $limit
     * @param int    $page
     * @param array  $columns
     * @param        $key
     * @param string $value
     * @param        $keyOrder
     *
     * @return mixed
     */
    public function getByPageOrderBy($limit = 10, $page = 1, array $columns = ['*'], $key, $value = '', $keyOrder)
    {
        return $this->make()->where($key, 'like', '%' . $value . '%')->orderBy(\DB::raw('ABS(' . $keyOrder . ')'))->paginate($limit, $columns);
    }

    /**
     * Search for many results by key and value
     *
     * @param  string $key
     * @param  mixed  $value
     * @param  array  $columns
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getManyBy($key, $value, array $columns = ['*'])
    {
        return $this->make()->where($key, $value)->get($columns);
    }

    /**
     * Search a single result by key and value
     *
     * @param  string $key
     * @param  mixed  $value
     * @param  array  $columns
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getFirstBy($key, $value, array $columns = ['*'])
    {
        return $this->make()->where($key, $value)->first($columns);
    }

    /**
     * Get last a single result by key and value
     *
     * @param       $key
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function getLastBy($key, $value, array $columns = ['*'])
    {
        return $this->make()->orderBy($key, 'desc')->first($columns);
    }

    /**
     * @param       $key
     * @param       $keyWhere
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function getLastByWhere($key, $keyWhere, $value, array $columns = ['*'])
    {
        return $this->make()->where($keyWhere, $value)->orderBy($key, 'desc')->first($columns);
    }

    /**
     * Search for many results where key is in array
     *
     * @param  string $key
     * @param  array  $array
     * @param  array  $columns
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getWhereIn($key, array $array, array $columns = ['*'])
    {
        return $this->make()->whereIn($key, $array)->get($columns);
    }

    /**
     * Get a new instance
     *
     * @param  array $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function instance(array $attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Magically call the Model instance
     *
     * @param  string $method
     * @param  array  $parameters
     *
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (method_exists($this->model, $method)) {
            return call_user_func_array([$this->model, $method], $parameters);
        }
        throw new \BadMethodCallException(sprintf('Method [%s] does not exist.', $method));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createSuccess()
    {
        return response()->json(
            [
                'success' => true,
                'result'  => [
                    'message' => 'Berhasil menyimpan data.',
                ],
            ]
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateSuccess()
    {
        return response()->json(
            [
                'success' => true,
                'result'  => [
                    'message' => 'Berhasil update data.',
                ],
            ]
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createError()
    {
        return response()->json(
            [
                'success' => false,
                'result'  => [
                    'message' => 'Gagal menyimpan data.',
                ],
            ], 500
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateError()
    {
        return response()->json(
            [
                'success' => false,
                'result'  => [
                    'message' => 'Gagal update data.',
                ],
            ], 500
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteSuccess()
    {
        return response()->json(
            [
                'success' => true,
                'result'  => [
                    'message' => 'berhasil hapus data.',
                ],
            ]
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteError()
    {
        return response()->json(
            [
                'success' => false,
                'result'  => [
                    'message' => 'Gagal hapus data.',
                ],
            ], 500
        );
    }

    /**
     * @param $msg
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorNotFound($msg)
    {
        return response()->json([
            'success' => false,
            'result'  => $msg,
        ]);
    }

}
