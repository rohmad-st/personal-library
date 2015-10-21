<?php namespace App\Http\Controllers\Kependudukan;

use App\Domain\Repositories\Kependudukan\KeluargaRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kependudukan\KeluargaFormRequest;

class KeluargaController extends Controller
{

    /**
     * @var KeluargaRepository
     */
    protected $keluarga;

    /**
     * @param KeluargaRepository $keluarga
     */
    public function __construct(KeluargaRepository $keluarga)
    {
        $this->keluarga = $keluarga;
        // $this->middleware('auth');
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
        return $this->keluarga->getByPage(10, $request->input('page'), $column = ['*'], $key = '', $request->input('term'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  KeluargaFormRequest $request
     *
     * @return mixed
     */
    public function store(KeluargaFormRequest $request)
    {
        return $this->keluarga->create($request->all());
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
        return $this->keluarga->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  KeluargaFormRequest $request
     * @param  int                 $id
     *
     * @return mixed
     */
    public function update(KeluargaFormRequest $request, $id)
    {
        return $this->keluarga->update($id, $request->all());
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
        return $this->keluarga->delete($id);
    }
}
