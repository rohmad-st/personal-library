<?php namespace App\Http\Controllers\Buku;

use App\Domain\Repositories\Buku\KategoriRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Buku\KategoriFormRequest;

class KategoriController extends Controller
{
    /**
     * @var KategoriRepository
     */
    protected $kategori;

    /**
     * @param KategoriRepository $kategori
     */
    public function __construct(KategoriRepository $kategori)
    {
        $this->kategori = $kategori;
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
        return $this->kategori->getByPage(10, $request->input('page'), $column = ['*'], $key = '', $request->input('term'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  KategoriFormRequest $request
     *
     * @return mixed
     */
    public function store(KategoriFormRequest $request)
    {
        return $this->kategori->create($request->all());
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
        return $this->kategori->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  KategoriFormRequest $request
     * @param  int                $id
     *
     * @return mixed
     */
    public function update(KategoriFormRequest $request, $id)
    {
        return $this->kategori->update($id, $request->all());
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
        return $this->kategori->delete($id);
    }
}
