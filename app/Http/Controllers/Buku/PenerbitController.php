<?php namespace App\Http\Controllers\Buku;

use App\Domain\Repositories\Buku\PenerbitRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Buku\PenerbitFormRequest;

class PenerbitController extends Controller
{
    /**
     * @var PenerbitRepository
     */
    protected $penerbit;

    /**
     * @param PenerbitRepository $penerbit
     */
    public function __construct(PenerbitRepository $penerbit)
    {
        $this->penerbit = $penerbit;
        $this->middleware('jwt.auth', ['except' => ['index']]);
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
        return $this->penerbit->getByPage(10, $request->input('page'), $column = ['*'], $key = '', $request->input('term'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PenerbitFormRequest $request
     *
     * @return mixed
     */
    public function store(PenerbitFormRequest $request)
    {
        return $this->penerbit->create($request->all());
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
        return $this->penerbit->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PenerbitFormRequest $request
     * @param  int                 $id
     *
     * @return mixed
     */
    public function update(PenerbitFormRequest $request, $id)
    {
        return $this->penerbit->update($id, $request->all());
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
        return $this->penerbit->delete($id);
    }
}
