<?php namespace App\Http\Requests\Kependudukan;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class KeluargaFormRequest extends Request
{

    /**
     * @var array
     */
    protected $attrs = [
        'nik_kk'  => 'NIK KK',
        'nama_kk' => 'Nama KK',
        'alamat'  => 'Alamat',
        'rt'      => 'RT',
        'rw'      => 'RW',
        'dusun'   => 'Dusun',
        'telepon' => 'Telepon',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik_kk'  => 'required|max:16|unique:keluarga,nik_kk',
            'nama_kk' => 'required|max:60',
            'alamat'  => 'required|max:225',
            'rt'      => 'required|max:3',
            'rw'      => 'required|max:3',
            'dusun'   => 'required|max:50',
            'telepon' => 'max:15',
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
                'nik_kk'  => $message->first('nik_kk'),
                'nama_kk' => $message->first('nama_kk'),
                'alamat'  => $message->first('alamat'),
                'rt'      => $message->first('rt'),
                'rw'      => $message->first('rw'),
                'dusun'   => $message->first('dusun'),
                'telepon' => $message->first('telepon'),
            ]
        ];
    }
}
