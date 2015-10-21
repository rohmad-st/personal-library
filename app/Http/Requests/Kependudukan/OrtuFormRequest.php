<?php namespace App\Http\Requests\Kependudukan;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class OrtuFormRequest extends Request
{
    /**
     * @var array
     */
    protected $attrs = [
        'nik'          => 'NIK',
        'nik_bapak'    => 'NIK Bapak',
        'nama_bapak'   => 'Nama Bapak',
        'status_bapak' => 'Status Bapak',
        'alamat_bapak' => 'Alamat Bapak',
        'nik_ibu'      => 'NIK Ibu',
        'nama_ibu'     => 'Nama Ibu',
        'status_ibu'   => 'Status Ibu',
        'alamat_ibu'   => 'Alamat Ibu',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik'          => 'required|max:16|unique:ortu,nik',
            'nik_bapak'    => 'required|max:16',
            'nama_bapak'   => 'required|max:50',
            'status_bapak' => 'required|max:25',
            'alamat_bapak' => 'required|max:50',
            'nik_ibu'      => 'required|max:16',
            'nama_ibu'     => 'required|max:50',
            'status_ibu'   => 'required|max:25',
            'alamat_ibu'   => 'required|max:50',
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
                'nik'          => $message->first('nik'),
                'nik_bapak'    => $message->first('nik_bapak'),
                'nama_bapak'   => $message->first('nama_bapak'),
                'status_bapak' => $message->first('status_bapak'),
                'alamat_bapak' => $message->first('alamat_bapak'),
                'nik_ibu'      => $message->first('nik_ibu'),
                'nama_ibu'     => $message->first('nama_ibu'),
                'status_ibu'   => $message->first('status_ibu'),
                'alamat_ibu'   => $message->first('alamat_ibu'),
            ]
        ];
    }
}
