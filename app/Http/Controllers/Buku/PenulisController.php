<?php namespace App\Http\Controllers\Buku;

use App\Domain\Repositories\Buku\PenulisRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Buku\PenulisFormRequest;

class PenulisController extends Controller
{
    /**
     * @var PenulisRepository
     */
    protected $penulis;

    /**
     * @param PenulisRepository $penulis
     */
    public function __construct(PenulisRepository $penulis)
    {
        $this->penulis = $penulis;
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
        return $this->penulis->getByPage(10, $request->input('page'), $column = ['*'], $key = '', $request->input('term'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PenulisFormRequest $request
     *
     * @return mixed
     */
    public function store(PenulisFormRequest $request)
    {
        return $this->penulis->create($request->all());
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
        return $this->penulis->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PenulisFormRequest $request
     * @param  int                $id
     *
     * @return mixed
     */
    public function update(PenulisFormRequest $request, $id)
    {
        return $this->penulis->update($id, $request->all());
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
        return $this->penulis->delete($id);
    }
}
