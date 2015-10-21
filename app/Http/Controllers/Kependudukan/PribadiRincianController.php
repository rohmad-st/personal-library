<?php namespace App\Http\Controllers\Kependudukan;

use App\Domain\Repositories\Kependudukan\PribadiRincianRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kependudukan\PribadiRincianFormRequest;

class PribadiRincianController extends Controller
{
    /**
     * @var PribadiRincianRepository
     */
    protected $pribadi;

    /**
     * @param PribadiRincianRepository $pribadi
     */
    public function __construct(PribadiRincianRepository $pribadi)
    {
        $this->pribadi = $pribadi;
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
        return $this->pribadi->getByPage(10, $request->input('page'), $column = ['*'], $key = '', $request->input('term'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PribadiRincianFormRequest $request
     *
     * @return mixed
     */
    public function store(PribadiRincianFormRequest $request)
    {
        return $this->pribadi->create($request->all());
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
        return $this->pribadi->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PribadiRincianFormRequest $request
     * @param  int                       $id
     *
     * @return mixed
     */
    public function update(PribadiRincianFormRequest $request, $id)
    {
        return $this->pribadi->update($id, $request->all());
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
        return $this->pribadi->delete($id);
    }
}
