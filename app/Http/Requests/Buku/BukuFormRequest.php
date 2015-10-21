<?php namespace App\Http\Requests\Buku;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class BukuFormRequest extends Request
{

    /**
     * @var array
     */
    protected $attrs = [
        'judul'        => 'Judul',
        'uraian'       => 'Uraian',
        'tahun'        => 'Tahun',
        'tanggal_beli' => 'Tanggal',
        'harga'        => 'Harga',
        'gambar'       => 'Gambar',
        'penulis_id'   => 'Penulis',
        'penerbit_id'  => 'Penerbit',
        'kategori_id'  => 'Kategori',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul'        => 'required|max:50',
            'uraian'       => 'max:225',
            'tahun'        => 'integer|digits_between:2,4',
            'tanggal_beli' => 'max:10',
            'harga'        => 'required|integer|max:2000000000',
            'gambar'       => 'required|max:100',
            'penulis_id'   => 'required|max:50',
            'penerbit_id'  => 'required|max:50',
            'kategori_id'  => 'required|max:50',
        ];
    }

    /**
     * @param $validator
     *
     * @return mixed
     */
    public function validator($validator)
    {
        return $validator->make($this->all(), $this->container->call([$this, 'rules']), $this->messages(), $this->attrs);
    }

    /**
     * @param Validator $validator
     *
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        $message = $validator->errors();

        return [
            'success'    => false,
            'validation' => [
                'judul'        => $message->first('judul'),
                'uraian'       => $message->first('uraian'),
                'tahun'        => $message->first('tahun'),
                'tanggal_beli' => $message->first('tanggal_beli'),
                'harga'        => $message->first('harga'),
                'gambar'       => $message->first('gambar'),
                'penulis_id'   => $message->first('penulis_id'),
                'penerbit_id'  => $message->first('penerbit_id'),
                'kategori_id'  => $message->first('kategori_id'),
            ]
        ];
    }
}
