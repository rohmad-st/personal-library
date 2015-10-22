<?php namespace App\Http\Requests\Buku;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class PenerbitFormRequest extends Request
{

    /**
     * @var array
     */
    protected $attrs = [
        'nama'        => 'Nama',
        'alamat'      => 'Alamat',
        'visi'        => 'Visi',
        'misi'        => 'Misi',
        'tahun'       => 'Tahun',
        'jumlah_buku' => 'Jumlah Buku',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama'        => 'required|max:50',
            'alamat'      => 'max:50',
            'visi'        => 'max:100',
            'misi'        => 'max:225',
            'tahun'       => 'integer|digits_between:2,4',
            'jumlah_buku' => 'integer|max:1000000000',
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
                'nama'        => $message->first('nama'),
                'alamat'      => $message->first('alamat'),
                'visi'        => $message->first('visi'),
                'misi'        => $message->first('misi'),
                'tahun'       => $message->first('tahun'),
                'jumlah_buku' => $message->first('jumlah_buku'),
            ]
        ];
    }
}
