<?php namespace App\Http\Controllers\Buku;

use App\Domain\Repositories\Buku\BukuRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Buku\BukuFormRequest;

class BukuController extends Controller
{
    /**
     * @var BukuRepository
     */
    protected $buku;

    /**
     * @param BukuRepository $buku
     */
    public function __construct(BukuRepository $buku)
    {
        $this->buku = $buku;
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
        return $this->buku->getByPage(10, $request->input('page'), $column = ['*'], $key = '', $request->input('term'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BukuFormRequest $request
     *
     * @return mixed
     */
    public function store(BukuFormRequest $request)
    {
        return $this->buku->create($request->all());
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
        return $this->buku->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BukuFormRequest $request
     * @param  int             $id
     *
     * @return mixed
     */
    public function update(BukuFormRequest $request, $id)
    {
        return $this->buku->update($id, $request->all());
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
        return $this->buku->delete($id);
    }
}
