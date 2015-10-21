<?php namespace App\Http\Controllers\Kependudukan;

use App\Domain\Repositories\Kependudukan\OrtuRepository;
use App\Domain\Repositories\Kependudukan\PribadiRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kependudukan\OrtuFormRequest;

class OrtuController extends Controller
{
    /**
     * @var PribadiRepository
     */
    protected $ortu;

    /**
     * @param OrtuRepository $ortu
     */
    public function __construct(OrtuRepository $ortu)
    {
        $this->ortu = $ortu;
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->ortu->getByPage(10, $request->input('page'), $column = ['*'], $key = '', $request->input('term'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrtuFormRequest $request
     *
     * @return mixed
     */
    public function store(OrtuFormRequest $request)
    {
        return $this->ortu->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function show($id)
    {
        return $this->ortu->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrtuFormRequest $request
     * @param  int             $id
     *
     * @return mixed
     */
    public function update(OrtuFormRequest $request, $id)
    {
        return $this->ortu->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->ortu->delete($id);
    }
}
