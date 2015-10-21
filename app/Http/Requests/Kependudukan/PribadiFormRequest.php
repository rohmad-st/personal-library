<?php namespace App\Http\Requests\Kependudukan;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class PribadiFormRequest extends Request
{
    /**
     * @var array
     */
    protected $attrs = [
        'keluarga_id'     => 'Keluarga',
        'nik'             => 'NIK',
        'title_depan'     => 'Title Depan',
        'title_belakang'  => 'Title Belakang',
        'nama'            => 'Nama',
        'kelamin'         => 'Jenis Kelamin',
        'tempat_lahir'    => 'Tempat Lahir',
        'tanggal_lahir'   => 'Tanggal Lahir',
        'golongan_darah'  => 'Golongan Darah',
        'agama'           => 'Agama',
        'status_kawin'    => 'Status Kawin',
        'status_keluarga' => 'Status Keluarga',
        'pendidikan'      => 'Pendidikan',
        'pekerjaan'       => 'Pekerjaan',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keluarga_id'     => 'required|max:50',
            'nik'             => 'required|max:25|unique:pribadi,nik',
            'nama'            => 'required|max:50',
            'kelamin'         => 'required|max:10',
            'tempat_lahir'    => 'required|max:35',
            'tanggal_lahir'   => 'required|max:10',
            'golongan_darah'  => 'max:2',
            'agama'           => 'required|max:12',
            'status_kawin'    => 'required|max:12',
            'status_keluarga' => 'required|max:50',
            'title_depan'     => 'max:20',
            'title_belakang'  => 'max:20',
            'pendidikan'      => 'max:35',
            'pekerjaan'       => 'max:35',
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
                'keluarga_id'     => $message->first('keluarga_id'),
                'nik'             => $message->first('nik'),
                'nama'            => $message->first('nama'),
                'kelamin'         => $message->first('kelamin'),
                'tempat_lahir'    => $message->first('tempat_lahir'),
                'tanggal_lahir'   => $message->first('tanggal_lahir'),
                'golongan_darah'  => $message->first('golongan_darah'),
                'agama'           => $message->first('agama'),
                'status_kawin'    => $message->first('status_kawin'),
                'status_keluarga' => $message->first('status_keluarga'),
                'title_depan'     => $message->first('title_depan'),
                'title_belakang'  => $message->first('title_belakang'),
                'pendidikan'      => $message->first('pendidikan'),
                'pekerjaan'       => $message->first('pekerjaan'),
            ]
        ];
    }
}
